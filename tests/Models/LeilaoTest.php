<?php

namespace Alura\PHPUnit\Tests\Models;

use Alura\PHPUnit\Model\Lance;
use Alura\PHPUnit\Model\Leilao;
use Alura\PHPUnit\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
  public function testLeilaoNaoDeveReceberLancesRepetidos()
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage('Usuário não pode propor 2 lances seguidos');
    $leilao = new Leilao('Variante');
    $ana = new Usuario('Ana');

    $leilao->recebeLance(new Lance($ana, 1000));
    $leilao->recebeLance(new Lance($ana, 1500));
  }
  /**
   * @dataProvider geraLances
   */
  public function testLeilaoDeveReceberLances(int $qtdLances, Leilao $leilao, array $valores)
  {
    self::assertCount($qtdLances, $leilao->getLances());

    foreach ($valores as $i => $valorEsperado) {
      self::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
    }
  }

  public function testLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage('Usuário não propor mais de 5 lances por leilão');
    $leilao = new Leilao('Brasília Amarela');
    $joao = new Usuario('João');
    $maria = new Usuario('Maria');

    $leilao->recebeLance(new Lance($joao, 1000));
    $leilao->recebeLance(new Lance($maria, 1500));
    $leilao->recebeLance(new Lance($joao, 2000));
    $leilao->recebeLance(new Lance($maria, 2500));
    $leilao->recebeLance(new Lance($joao, 3000));
    $leilao->recebeLance(new Lance($maria, 3500));
    $leilao->recebeLance(new Lance($joao, 4000));
    $leilao->recebeLance(new Lance($maria, 4500));
    $leilao->recebeLance(new Lance($joao, 5000));
    $leilao->recebeLance(new Lance($maria, 5500));
    $leilao->recebeLance(new Lance($joao, 6000));
  }

  public static function geraLances()
  {
    $joao = new Usuario("João");
    $maria = new Usuario("Maria");

    $leilaoCom2Lances = new Leilao("PS5");
    $leilaoCom2Lances->recebeLance(new Lance($maria, 4000));
    $leilaoCom2Lances->recebeLance(new Lance($joao, 5000));

    $leilaoCom1Lance = new Leilao("PS4");
    $leilaoCom1Lance->recebeLance(new Lance($maria, 3000));

    return [
      "2-lances" => [2, $leilaoCom2Lances, [4000, 5000]],
      "1-lance" => [1, $leilaoCom1Lance, [3000]]
    ];
  }
}
