<?php

namespace Alura\PHPUnit\Tests\Service;

use Alura\PHPUnit\Model\Lance;
use Alura\PHPUnit\Model\Leilao;
use PHPUnit\Framework\TestCase;
use Alura\PHPUnit\Model\Usuario;
use Alura\PHPUnit\Service\Avaliador;

class AvaliadorTest extends TestCase
{
  public function testAvaliadorDeveEncontrarOMaioValorDeLancesEmOrdemCrescente()
  {
    // Arrange - Given
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");

    $leilao->recebeLance(new Lance($kamilly, 900000));
    $leilao->recebeLance(new Lance($rickson, 1000000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);
    $maiorValor = $leiloeiro->getMaiorValor();

    // Assert - Then
    self::assertEquals(1000000, $maiorValor);
  }

  public function testAvaliadorDeveEncontrarOMaioValorDeLancesEmOrdemDecrescente()
  {
    // Arrange - Given
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");

    $leilao->recebeLance(new Lance($rickson, 1000000));
    $leilao->recebeLance(new Lance($kamilly, 900000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);
    $maiorValor = $leiloeiro->getMaiorValor();

    // Assert - Then
    self::assertEquals(1000000, $maiorValor);
  }

  public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente()
  {
    // Arrange - Given
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");

    $leilao->recebeLance(new Lance($rickson, 1000000));
    $leilao->recebeLance(new Lance($kamilly, 900000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);
    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then
    self::assertEquals(900000, $menorValor);
  }

  public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente()
  {
    // Arrange - Given
    $leilao = new Leilao("BMW Audi A4 0KM");

    $rickson = new Usuario("Rickson Lucas");
    $kamilly = new Usuario("Kamilly Vitoria");

    $leilao->recebeLance(new Lance($kamilly, 900000));
    $leilao->recebeLance(new Lance($rickson, 1000000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);
    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then
    self::assertEquals(900000, $menorValor);
  }
}
