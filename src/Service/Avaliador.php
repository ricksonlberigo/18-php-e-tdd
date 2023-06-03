<?php

namespace Alura\PHPUnit\Service;

use Alura\PHPUnit\Model\Leilao;

class Avaliador
{
  private float $maiorValor;

  public function avalia(Leilao $leilao): void
  {
    $lances = $leilao->getLances();
    $ultimoLance = $lances[count($lances) - 1];
    $this->maiorValor = $ultimoLance->getValor();
  }

  public function getMaiorValor(): float
  {
    return $this->maiorValor;
  }
}
