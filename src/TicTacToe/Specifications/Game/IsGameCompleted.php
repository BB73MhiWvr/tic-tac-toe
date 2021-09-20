<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game;

use TicTacToe\Entities\Game;

class IsGameCompleted implements GameSpecification
{
    public function isSatisfiedBy(Game $game): bool
    {
        if ($game->getBoardService()->isBoardFilled()) {
            return true;
        }

        return false;
    }
}
