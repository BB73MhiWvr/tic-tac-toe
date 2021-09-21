<?php
declare(strict_types=1);

namespace TicTacToe\Handlers\Move;

use TicTacToe\Entities\Game;
use TicTacToe\Specifications\Move\IsProperBoardMove;
use TicTacToe\Specifications\Move\IsProperPlayerMove;

class MoveValidatorFactory
{
    public function createValidatorsChain(Game $game): AbstractMoveValidator
    {
        return new ProperPlayerMoveValidator(
            new IsProperPlayerMove($game->getPlayerService()),
            new ProperBoardMoveValidator(
                new IsProperBoardMove($game->getBoardService())
            )
        );
    }
}
