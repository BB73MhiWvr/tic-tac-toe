<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Services\BoardService;

class IsProperBoardMove implements MoveSpecification
{
    private BoardService $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function isSatisfiedBy(Move $move): bool
    {
        if ($move->getColumn() >= $this->boardService->getBoardSize()) {
            return false;
        }

        if ($move->getColumn() < 0) {
            return false;
        }

        if ($move->getRow() >= $this->boardService->getBoardSize()) {
            return false;
        }

        if ($move->getRow() < 0) {
            return false;
        }

        if ($this->boardService->isEmptySpaceOnBoard($move)) {
            return true;
        }

        return false;
    }
}
