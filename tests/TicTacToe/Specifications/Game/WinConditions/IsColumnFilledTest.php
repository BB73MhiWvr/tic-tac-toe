<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game\WinConditions;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;
use TicTacToe\Specifications\Game\WinConditions\IsColumnFilled;

class IsColumnFilledTest extends TestCase
{
    public function testShouldReturnFalseForNotFoundColumn(): void
    {
        $player = new Player('player');
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($player, 0, 0));
        $boardService->addMoveToBoard(new Move($player, 0, 1));
        $boardService->addMoveToBoard(new Move($player, 1, 0));
        $boardService->addMoveToBoard(new Move($player, 1, 2));
        $boardService->addMoveToBoard(new Move($player, 2, 0));
        $boardService->addMoveToBoard(new Move($player, 2, 2));

        $isColumnFilled = new IsColumnFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $player));
    }

    public function testShouldReturnTrueForFoundColumn(): void
    {
        $player = new Player('player');
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($player, 2, 0));
        $boardService->addMoveToBoard(new Move($player, 2, 1));
        $boardService->addMoveToBoard(new Move($player, 2, 2));

        $isColumnFilled = new IsColumnFilled();
        self::assertTrue($isColumnFilled->isSatisfiedBy($boardService, $player));
    }

    public function testShouldReturnFalseForNotFoundColumnForPlayer(): void
    {
        $player = new Player('player');
        $otherPlayer = new Player('other player');
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($otherPlayer, 2, 0));
        $boardService->addMoveToBoard(new Move($otherPlayer, 2, 1));
        $boardService->addMoveToBoard(new Move($otherPlayer, 2, 2));

        $isColumnFilled = new IsColumnFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $player));
    }
}