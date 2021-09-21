<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

use TicTacToe\Entities\Game;

interface Decorator
{
    public function decorate(Game $game): array;
}
