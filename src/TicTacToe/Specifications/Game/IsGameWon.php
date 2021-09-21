<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game;

use TicTacToe\Entities\Game;
use TicTacToe\Specifications\Game\WinConditions\WinConditionSpecification;

class IsGameWon implements GameSpecification
{
    /** @var WinConditionSpecification[] $specifications */
    private array $specifications;

    public function __construct(WinConditionSpecification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Game $game): bool
    {
        $boardService = $game->getBoardService();
        $playerId = $game->getPlayerService()->getActivePlayer()->getId();

        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($boardService, $playerId)) {
                return true;
            }
        }

        return false;
    }
}
