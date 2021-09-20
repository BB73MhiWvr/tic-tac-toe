<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Move;

use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;
use TicTacToe\Specifications\Move\IsProperBoardMove;
use PHPUnit\Framework\TestCase;

class IsProperBoardMoveTest extends TestCase
{
    public function testShouldReturnFalseForColumnIndexSmallerThanZero(): void
    {
        $boardService = new BoardService(new Board());

        $move = new Move(new Player('player'), -1, 0);

        $isProperBoardMove = new IsProperBoardMove($boardService);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForColumnIndexExceedingBoardSize(): void
    {
        $boardService = new BoardService(new Board());

        $move = new Move(new Player('player'), $boardService->getBoardSize(), 0);

        $isProperBoardMove = new IsProperBoardMove($boardService);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForRowIndexSmallerThanZero(): void
    {
        $boardService = new BoardService(new Board());

        $move = new Move(new Player('player'), 0, -1);

        $isProperBoardMove = new IsProperBoardMove($boardService);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForRowIndexExceedingBoardSize(): void
    {
        $boardService = new BoardService(new Board());

        $move = new Move(new Player('player'), 0, $boardService->getBoardSize());

        $isProperBoardMove = new IsProperBoardMove($boardService);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForOccupiedSpaceOnBoard(): void
    {
        $boardService = new BoardService(new Board());
        $boardService->addMoveToBoard(new Move(new Player('player'), 1, 1));

        $move = new Move(new Player('player'), 1, 1);

        $isProperBoardMove = new IsProperBoardMove($boardService);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnTrueForEmptySpaceOnBoard(): void
    {
        $boardService = new BoardService(new Board());
        $boardService->addMoveToBoard(new Move(new Player('player'), 0, 0));
        $boardService->addMoveToBoard(new Move(new Player('player'), 0, 2));

        $move = new Move(new Player('player'), 0, 1);

        $isProperBoardMove = new IsProperBoardMove($boardService);
        self::assertTrue($isProperBoardMove->isSatisfiedBy($move));
    }
}
