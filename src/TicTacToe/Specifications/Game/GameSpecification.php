<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game;

use TicTacToe\Entities\Game;

interface GameSpecification
{
    public function isSatisfiedBy(Game $game): bool;
}
