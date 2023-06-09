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
    $leilao = new Leilao("Variante");
    $ana = new Usuario("Ana");

    $leilao->recebeLance(new Lance($ana, 1000));

    self::assertCount(1, $leilao->getLances());
    self::assertEquals(1000, $leilao->getLances()[0]->getValor());
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
