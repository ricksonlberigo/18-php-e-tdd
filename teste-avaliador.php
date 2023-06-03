<?php

use Alura\PHPUnit\Model\Leilao;
use Alura\PHPUnit\Service\Avaliador;
use Alura\PHPUnit\Model\Lance;
use Alura\PHPUnit\Model\Usuario;

require_once __DIR__ . "/vendor/autoload.php";

$leilao = new Leilao("BMW Audi A4 0KM");

$rickson = new Usuario("Rickson Lucas");
$kamilly = new Usuario("Kamilly Vitoria");

$leilao->recebeLance(new Lance($kamilly, 900000));
$leilao->recebeLance(new Lance($rickson, 1000000));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

echo $maiorValor;
