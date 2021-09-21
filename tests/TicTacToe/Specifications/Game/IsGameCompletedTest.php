<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game;

use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Entities\Move;
use TicTacToe\Specifications\Game\IsGameCompleted;
use PHPUnit\Framework\TestCase;

class IsGameCompletedTest extends TestCase
{
    use PrepareGameTrait;

    public function testShouldReturnFalseForNotFilledBoard(): void
    {
        $game = $this->prepareGame();
        $isGameCompleted = new IsGameCompleted();

        self::assertFalse($isGameCompleted->isSatisfiedBy($game));
    }

    public function testShouldReturnTrueForFilledBoard(): void
    {
        $game = $this->prepareGame();
        $boardService = $game->getBoardService();

        $boardService->addMoveToBoard(new Move('player', 0, 0));
        $boardService->addMoveToBoard(new Move('player', 1, 0));
        $boardService->addMoveToBoard(new Move('player', 2, 0));
        $boardService->addMoveToBoard(new Move('player', 0, 1));
        $boardService->addMoveToBoard(new Move('player', 1, 1));
        $boardService->addMoveToBoard(new Move('player', 2, 1));
        $boardService->addMoveToBoard(new Move('player', 0, 2));
        $boardService->addMoveToBoard(new Move('player', 1, 2));
        $boardService->addMoveToBoard(new Move('player', 2, 2));

        $isGameCompleted = new IsGameCompleted();

        self::assertTrue($isGameCompleted->isSatisfiedBy($game));
    }
}
