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
    if (!empty($this->lances) && $lance->getUsuario() == $this->ehDoUltimoUsuario($lance)) {
      return;
    }

    $this->lances[] = $lance;
  }

  private function ehDoUltimoUsuario(Lance $lance): bool
  {
    $ultimoLance = $this->lances[array_key_last($this->lances)];
    return $lance->getUsuario() === $ultimoLance->getUsuario();
  }

  /**
   * @return Lance[]
   */
  public function getLances(): array
  {
    return $this->lances;
  }
}
