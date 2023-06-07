<?php

namespace Alura\PHPUnit\Tests\Service;

use Alura\PHPUnit\Model\Lance;
use Alura\PHPUnit\Model\Leilao;
use PHPUnit\Framework\TestCase;
use Alura\PHPUnit\Model\Usuario;
use Alura\PHPUnit\Service\Avaliador;

class AvaliadorTest extends TestCase
{
  /**
   * @dataProvider leilaoEmOrdemAleatoria
   * @dataProvider leilaoEmOrdemCrescente
   * @dataProvider leilaoEmOrdemDecrescente
   */
  public function testAvaliadorDeveEncontrarOMaioValorDeLances(Leilao $leilao)
  {
    // Arrange - Given / Preparamos o cenário do teste
    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);
    $maiorValor = $leiloeiro->getMaiorValor();

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
    // Arrange - Given / Preparamos o cenário do teste
    $leiloeiro = new Avaliador();

    // Act - When / Executamos o código a ser testado
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

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
    $avaliador = new Avaliador();
    $avaliador->avalia($leilao);

    $maiores = $avaliador->getMaioresLances();
    self::assertCount(3, $maiores);
    static::assertEquals(2500, $maiores[0]->getValor());
    static::assertEquals(2000, $maiores[1]->getValor());
    static::assertEquals(1700, $maiores[2]->getValor());
  }

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
      [$leilao]
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
      [$leilao]
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
      [$leilao]
    ];
  }
}
