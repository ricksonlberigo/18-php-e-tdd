<?php

namespace Alura\PHPUnit\Service;

use Alura\PHPUnit\Model\Leilao;

class Avaliador
{
  private float $maiorValor = 0;

  public function avalia(Leilao $leilao): void
  {
    foreach ($leilao->getLances() as $lance) {
      if ($lance->getValor() > $this->maiorValor) {
        $this->maiorValor = $lance->getValor();
      }
    }
  }

  public function getMaiorValor(): float
  {
    return $this->maiorValor;
  }
}
