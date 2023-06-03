<?php

namespace Alura\PHPUnit\Model;

use Alura\PHPUnit\Model\Lance;

class Leilao
{
  /** @var Lance[] */
  private array $lances;

  public function __construct(private string $descricao)
  {
    $this->lances = [];
  }

  public function recebeLance(Lance $lance)
  {
    $this->lances[] = $lance;
  }

  /**
   * @return Lance[]
   */
  public function getLances(): array
  {
    return $this->lances;
  }
}
