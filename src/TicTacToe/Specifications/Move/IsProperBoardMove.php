<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Move;

use TicTacToe\Entities\Game;
use TicTacToe\Entities\Move;

class IsProperBoardMove implements MoveSpecification
{
    private Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function isSatisfiedBy(Move $move): bool
    {
        if ($this->game->isWon()) {
            return false;
        }

        if ($move->getColumn() >= $this->game->getBoardService()->getBoardSize()) {
            return false;
        }

        if ($move->getColumn() < 0) {
            return false;
        }

        if ($move->getRow() >= $this->game->getBoardService()->getBoardSize()) {
            return false;
        }

        if ($move->getRow() < 0) {
            return false;
        }

        if ($this->game->getBoardService()->isEmptySpaceOnBoard($move)) {
            return true;
        }

        return false;
    }
}
