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
    if (!empty($this->lances) && $this->ehDoUltimoUsuario($lance)) {
      return;
    }

    $totalLancesUsuario = $this->quantidadeLancesPorUsuario($lance->getUsuario());

    if ($totalLancesUsuario >= 5) {
      return;
    }

    $this->lances[] = $lance;
  }

  private function quantidadeLancesPorUsuario(Usuario $usuario)
  {
    $totalLancesUsuario = array_reduce(
      $this->lances,
      function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
        if ($lanceAtual->getUsuario() == $usuario) {
          return $totalAcumulado + 1;
        }

        return $totalAcumulado;
      },
      0
    );

    return $totalLancesUsuario;
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
