<?php

namespace Alura\PHPUnit\Tests\Service;

use Alura\PHPUnit\Model\Lance;
use Alura\PHPUnit\Model\Leilao;
use PHPUnit\Framework\TestCase;
use Alura\PHPUnit\Model\Usuario;
use Alura\PHPUnit\Service\Avaliador;

class AvaliadorTest extends TestCase
{
  /** @var Avaliador */
  private $leiloeiro;

  protected function setUp(): void
  {
    $this->leiloeiro = new Avaliador();
  }

  /**
   * @dataProvider leilaoEmOrdemAleatoria
   * @dataProvider leilaoEmOrdemCrescente
   * @dataProvider leilaoEmOrdemDecrescente
   */
  public function testAvaliadorDeveEncontrarOMaioValorDeLances(Leilao $leilao)
  {
    // Act - When
    $this->leiloeiro->avalia($leilao);

    $maiorValor = $this->leiloeiro->getMaiorValor();

    // Assert - Then
    self::assertEquals(2500, $maiorValor);
  }

  /**
   * @dataProvider leilaoEmOrdemAleatoria
   * @dataProvider leilaoEmOrdemCrescente
   * @dataProvider leilaoEmOrdemDecrescente
   */
  public function testAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao)
  {
    // Act - When
    $this->leiloeiro->avalia($leilao);

    $menorValor = $this->leiloeiro->getMenorValor();

    // Assert - Then / Verificamos se a saída é a esperada
    self::assertEquals(1700, $menorValor);
  }

  /**
   * @dataProvider leilaoEmOrdemAleatoria
   * @dataProvider leilaoEmOrdemCrescente
   * @dataProvider leilaoEmOrdemDecrescente
   */
  public function testAvaliadorDeveBuscarOs3MaioresValores(Leilao $leilao)
  {
    // Act - When
    $this->leiloeiro->avalia($leilao);

    $maiores = $this->leiloeiro->getMaioresLances();

    self::assertCount(3, $maiores);
    static::assertEquals(2500, $maiores[0]->getValor());
    static::assertEquals(2000, $maiores[1]->getValor());
    static::assertEquals(1700, $maiores[2]->getValor());
  }

  public function testLeilaoVazioNaoPodeSerAvaliado()
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage("Não é possível avaliar um leilão vazio!");
    $leilao = new Leilao("Fusca Azul");
    $this->leiloeiro->avalia($leilao);
  }

  public function testLeilaoFinalizadoNaoPodeSerAtualizado()
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage("Leilão esta finalizado");

    $leilao = new Leilao("pc gamer");
    $mario = new Usuario("Mario");

    $leilao->recebeLance(new Lance($mario, 2000));
    $leilao->finaliza();

    $this->leiloeiro->avalia($leilao);
  }

  /* ---------- DADOS ---------- */
  public static function leilaoEmOrdemCrescente()
  {
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");
    $kevinny = new Usuario("Kevinny Silva");

    $leilao->recebeLance(new Lance($kevinny, 1700));
    $leilao->recebeLance(new Lance($kamilly, 2000));
    $leilao->recebeLance(new Lance($rickson, 2500));

    return [
      "ordem-crescente" => [$leilao]
    ];
  }

  public static function leilaoEmOrdemDecrescente()
  {
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");
    $kevinny = new Usuario("Kevinny Silva");

    $leilao->recebeLance(new Lance($rickson, 2500));
    $leilao->recebeLance(new Lance($kamilly, 2000));
    $leilao->recebeLance(new Lance($kevinny, 1700));

    return [
      "ordem-decrescente" => [$leilao]
    ];
  }

  public static function leilaoEmOrdemAleatoria()
  {
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");
    $kevinny = new Usuario("Kevinny Silva");

    $leilao->recebeLance(new Lance($kamilly, 2000));
    $leilao->recebeLance(new Lance($rickson, 2500));
    $leilao->recebeLance(new Lance($kevinny, 1700));

    return [
      "ordem-aleatória" => [$leilao]
    ];
  }
}
