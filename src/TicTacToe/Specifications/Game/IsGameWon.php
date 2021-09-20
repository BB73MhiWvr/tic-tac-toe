<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game;

use TicTacToe\Entities\Game;
use TicTacToe\Specifications\Game\WinConditions\WinConditionSpecification;

class IsGameWon implements GameSpecification
{
    private array $specifications;

    public function __construct(WinConditionSpecification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Game $game): bool
    {
        $boardService = $game->getBoardService();
        $player = $game->getPlayerService()->getActivePlayer();

        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($boardService, $player)) {
                return true;
            }
        }

        return false;
    }
}
