<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game\WinConditions;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;
use TicTacToe\Specifications\Game\WinConditions\IsRightDiagonalFilled;

class IsRightDiagonalFilledTest extends TestCase
{
    public function testShouldReturnFalseForNotFoundLeftDiagonal(): void
    {
        $player = new Player('player');
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($player, 0, 0));
        $boardService->addMoveToBoard(new Move($player, 0, 1));
        $boardService->addMoveToBoard(new Move($player, 1, 0));
        $boardService->addMoveToBoard(new Move($player, 1, 1));
        $boardService->addMoveToBoard(new Move($player, 1, 2));
        $boardService->addMoveToBoard(new Move($player, 2, 1));
        $boardService->addMoveToBoard(new Move($player, 2, 2));

        $isColumnFilled = new IsRightDiagonalFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $player));
    }

    public function testShouldReturnTrueForFoundLeftDiagonal(): void
    {
        $player = new Player('player');
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($player, 2, 0));
        $boardService->addMoveToBoard(new Move($player, 1, 1));
        $boardService->addMoveToBoard(new Move($player, 0, 2));

        $isColumnFilled = new IsRightDiagonalFilled();
        self::assertTrue($isColumnFilled->isSatisfiedBy($boardService, $player));
    }

    public function testShouldReturnFalseForNotFoundLeftDiagonalForPlayer(): void
    {
        $player = new Player('player');
        $otherPlayer = new Player('other player');
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($otherPlayer, 2, 0));
        $boardService->addMoveToBoard(new Move($otherPlayer, 1, 1));
        $boardService->addMoveToBoard(new Move($otherPlayer, 0, 2));

        $isColumnFilled = new IsRightDiagonalFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $player));
    }
}
