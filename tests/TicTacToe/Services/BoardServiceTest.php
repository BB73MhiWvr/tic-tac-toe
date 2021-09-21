<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Services;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Services\BoardService;

class BoardServiceTest extends TestCase
{
    public function testShouldReturnFalseOnNotFilledBoard(): void
    {
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move('player1', 0, 0));
        $boardService->addMoveToBoard(new Move('player2', 0, 1));
        $boardService->addMoveToBoard(new Move('player1', 0, 2));

        self::assertFalse($boardService->isBoardFilled());
    }

    public function testShouldReturnTrueOnFullBoard(): void
    {
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move('player1', 0, 0));
        $boardService->addMoveToBoard(new Move('player2', 0, 1));
        $boardService->addMoveToBoard(new Move('player1', 0, 2));
        $boardService->addMoveToBoard(new Move('player2', 1, 0));
        $boardService->addMoveToBoard(new Move('player1', 1, 1));
        $boardService->addMoveToBoard(new Move('player2', 1, 2));
        $boardService->addMoveToBoard(new Move('player1', 2, 0));
        $boardService->addMoveToBoard(new Move('player2', 2, 1));
        $boardService->addMoveToBoard(new Move('player1', 2, 2));

        self::assertTrue($boardService->isBoardFilled());
    }

    public function testShouldClearBoard(): void
    {
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move('player', 0, 0));
        self::assertNotEmpty($boardService->getMoves());

        $boardService->clearBoard();
        self::assertEmpty($boardService->getMoves());
    }

    public function testShouldReturnTrueOnEmptySpaceOnBoardForMove(): void
    {
        $boardService = new BoardService(new Board());
        $move = new Move('player', 0, 0);

        self::assertTrue($boardService->isEmptySpaceOnBoard($move));
    }

    public function testShouldReturnFalseOnNotEmptySpaceOnBoardForMove(): void
    {
        $boardService = new BoardService(new Board());
        $boardService->addMoveToBoard(new Move('player', 0, 0));
        $move = new Move('player', 0, 0);

        self::assertFalse($boardService->isEmptySpaceOnBoard($move));
    }

    public function testShouldAddMoveToBoard(): void
    {
        $boardService = new BoardService(new Board());
        $moves = $boardService->getMoves();

        $boardService->addMoveToBoard(new Move('player', 1, 1));
        self::assertNotSameSize($moves, $boardService->getMoves());
    }

    public function testShouldNotAddMoveToBoard(): void
    {
        $boardService = new BoardService(new Board());
        $boardService->addMoveToBoard(new Move('player', 1, 1));
        $moves = $boardService->getMoves();

        $boardService->addMoveToBoard(new Move('player', 1, 1));
        self::assertSameSize($moves, $boardService->getMoves());
    }

    public function testShouldReturnEmptyArrayForNoPlayerMoves(): void
    {
        $boardService = new BoardService(new Board());
        $boardService->addMoveToBoard(new Move('player', 1, 1));
        $boardService->addMoveToBoard(new Move('player', 2, 2));

        self::assertEmpty($boardService->getPlayerMoves('another player'));
    }

    public function testShouldReturnNotEmptyArrayForPlayerMoves(): void
    {
        $boardService = new BoardService(new Board());
        $boardService->addMoveToBoard(new Move('player', 0, 0));

        self::assertNotEmpty($boardService->getMoves());
    }
}
