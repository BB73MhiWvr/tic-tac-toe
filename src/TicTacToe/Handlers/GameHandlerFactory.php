<?php
declare(strict_types=1);

namespace TicTacToe\Handlers;

use TicTacToe\Specifications\Game\IsGameCompleted;
use TicTacToe\Specifications\Game\IsGameWon;
use TicTacToe\Specifications\Game\WinConditions\IsColumnFilled;
use TicTacToe\Specifications\Game\WinConditions\IsLeftDiagonalFilled;
use TicTacToe\Specifications\Game\WinConditions\IsRightDiagonalFilled;
use TicTacToe\Specifications\Game\WinConditions\IsRowFilled;

class GameHandlerFactory
{
    public function createHandlersChain(): AbstractGameHandler
    {
        return new GameWon(
            new IsGameWon(
                new IsRowFilled(),
                new IsColumnFilled(),
                new IsLeftDiagonalFilled(),
                new IsRightDiagonalFilled()
            ),
            new GameTied(
                new IsGameCompleted(),
                new GameContinues()
            )
        );
    }
}
