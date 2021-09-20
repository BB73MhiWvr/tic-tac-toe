<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Traits;

use TicTacToe\Entities\Board;
use TicTacToe\Entities\Game;
use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;
use TicTacToe\Services\PlayerService;
use TicTacToe\Strategy\NextRoundBeginner\NextRoundBeginnerStrategy;
use TicTacToe\Strategy\NextRoundBeginner\WinnerBegins;

trait PrepareGameTrait
{
    private function prepareGame(?NextRoundBeginnerStrategy $nextRoundBeginnerStrategy = null): Game
    {
        return new Game(
            new BoardService(new Board()),
            new PlayerService(new Player('first'), new Player('second')),
            $nextRoundBeginnerStrategy ?? new WinnerBegins()
        );
    }
}
