<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game;

use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
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

        $boardService->addMoveToBoard(new Move(new Player('first'), 0, 0));
        $boardService->addMoveToBoard(new Move(new Player('first'), 1, 0));
        $boardService->addMoveToBoard(new Move(new Player('first'), 2, 0));
        $boardService->addMoveToBoard(new Move(new Player('first'), 0, 1));
        $boardService->addMoveToBoard(new Move(new Player('first'), 1, 1));
        $boardService->addMoveToBoard(new Move(new Player('first'), 2, 1));
        $boardService->addMoveToBoard(new Move(new Player('first'), 0, 2));
        $boardService->addMoveToBoard(new Move(new Player('first'), 1, 2));
        $boardService->addMoveToBoard(new Move(new Player('first'), 2, 2));

        $isGameCompleted = new IsGameCompleted();

        self::assertTrue($isGameCompleted->isSatisfiedBy($game));
    }
}
