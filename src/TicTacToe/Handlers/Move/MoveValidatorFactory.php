<?php
declare(strict_types=1);

namespace TicTacToe\Handlers\Move;

use TicTacToe\Entities\Game;
use TicTacToe\Specifications\Move\IsProperBoardMove;
use TicTacToe\Specifications\Move\IsProperPlayer;
use TicTacToe\Specifications\Move\IsProperPlayerMove;

class MoveValidatorFactory
{
    public function createValidatorsChain(Game $game): AbstractMoveValidator
    {
        return new ProperPlayerValidator(
            new IsProperPlayer($game->getPlayerService()),
            new ProperPlayerMoveValidator(
                new IsProperPlayerMove($game->getPlayerService()),
                new ProperBoardMoveValidator(
                    new IsProperBoardMove($game)
                )
            )
        );
    }
}
