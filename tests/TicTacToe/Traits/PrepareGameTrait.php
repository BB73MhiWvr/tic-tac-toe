<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Traits;

use TicTacToe\Entities\Game;
use TicTacToe\Entities\Player;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\Strategy\NextRoundBeginner\NextRoundBeginnerStrategy;

trait PrepareGameTrait
{
    private function prepareGame(?NextRoundBeginnerStrategy $nextRoundBeginnerStrategy = null): Game
    {
        return new Game(
            new Player('player one'),
            new Player('player two'),
            $nextRoundBeginnerStrategy ?? new LooserBegins()
        );
    }
}
