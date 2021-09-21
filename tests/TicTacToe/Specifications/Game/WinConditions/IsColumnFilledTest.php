<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game\WinConditions;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Services\BoardService;
use TicTacToe\Specifications\Game\WinConditions\IsColumnFilled;

class IsColumnFilledTest extends TestCase
{
    public function testShouldReturnFalseForNotFoundColumn(): void
    {
        $playerId = 'player';
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($playerId, 0, 0));
        $boardService->addMoveToBoard(new Move($playerId, 0, 1));
        $boardService->addMoveToBoard(new Move($playerId, 1, 0));
        $boardService->addMoveToBoard(new Move($playerId, 1, 2));
        $boardService->addMoveToBoard(new Move($playerId, 2, 0));
        $boardService->addMoveToBoard(new Move($playerId, 2, 2));

        $isColumnFilled = new IsColumnFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $playerId));
    }

    public function testShouldReturnTrueForFoundColumn(): void
    {
        $playerId = 'player';
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($playerId, 2, 0));
        $boardService->addMoveToBoard(new Move($playerId, 2, 1));
        $boardService->addMoveToBoard(new Move($playerId, 2, 2));

        $isColumnFilled = new IsColumnFilled();
        self::assertTrue($isColumnFilled->isSatisfiedBy($boardService, $playerId));
    }

    public function testShouldReturnFalseForNotFoundColumnForPlayer(): void
    {
        $playerId = 'player';
        $otherPlayerId = 'other player';
        $boardService = new BoardService(new Board());

        $boardService->addMoveToBoard(new Move($otherPlayerId, 2, 0));
        $boardService->addMoveToBoard(new Move($otherPlayerId, 2, 1));
        $boardService->addMoveToBoard(new Move($otherPlayerId, 2, 2));

        $isColumnFilled = new IsColumnFilled();
        self::assertFalse($isColumnFilled->isSatisfiedBy($boardService, $playerId));
    }
}
