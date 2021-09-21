<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game\WinConditions;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Services\BoardService;
use TicTacToe\Specifications\Game\WinConditions\IsRowFilled;

class IsRowFilledTest extends TestCase
{
    public function testShouldReturnFalseForNotFoundRow(): void
    {
        $playerId = 'player';
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($playerId, 0, 0));
        $boardService->addMoveToBoard(new Move($playerId, 1, 0));
        $boardService->addMoveToBoard(new Move($playerId, 0, 1));
        $boardService->addMoveToBoard(new Move($playerId, 2, 1));
        $boardService->addMoveToBoard(new Move($playerId, 0, 2));
        $boardService->addMoveToBoard(new Move($playerId, 2, 2));

        $isColumnFilled = new IsRowFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $playerId));
    }

    public function testShouldReturnTrueForFoundRow(): void
    {
        $playerId = 'player';
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($playerId, 2, 2));
        $boardService->addMoveToBoard(new Move($playerId, 1, 2));
        $boardService->addMoveToBoard(new Move($playerId, 0, 2));

        $isColumnFilled = new IsRowFilled();
        self::assertTrue($isColumnFilled->isSatisfiedBy($boardService, $playerId));
    }

    public function testShouldReturnFalseForNotFoundRowForPlayer(): void
    {
        $playerId = 'player';
        $otherPlayerId = 'other player';
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($otherPlayerId, 2, 2));
        $boardService->addMoveToBoard(new Move($otherPlayerId, 1, 2));
        $boardService->addMoveToBoard(new Move($otherPlayerId, 0, 2));

        $isColumnFilled = new IsRowFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $playerId));
    }
}
