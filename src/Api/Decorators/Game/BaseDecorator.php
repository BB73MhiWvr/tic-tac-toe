<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

use TicTacToe\Entities\Game;

class BaseDecorator implements Decorator
{
    public function decorate(Game $game): array
    {
        return [];
    }
}
