<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Move;

use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Entities\Move;
use TicTacToe\Specifications\Move\IsProperBoardMove;
use PHPUnit\Framework\TestCase;

class IsProperBoardMoveTest extends TestCase
{
    use PrepareGameTrait;

    public function testShouldReturnFalseForColumnIndexSmallerThanZero(): void
    {
        $game = $this->prepareGame();

        $move = new Move('player', -1, 0);

        $isProperBoardMove = new IsProperBoardMove($game);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForColumnIndexExceedingBoardSize(): void
    {
        $game = $this->prepareGame();

        $move = new Move('player', $game->getBoardService()->getBoardSize(), 0);

        $isProperBoardMove = new IsProperBoardMove($game);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForRowIndexSmallerThanZero(): void
    {
        $game = $this->prepareGame();

        $move = new Move('player', 0, -1);

        $isProperBoardMove = new IsProperBoardMove($game);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForRowIndexExceedingBoardSize(): void
    {
        $game = $this->prepareGame();

        $move = new Move('player', 0, $game->getBoardService()->getBoardSize());

        $isProperBoardMove = new IsProperBoardMove($game);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnFalseForOccupiedSpaceOnBoard(): void
    {
        $game = $this->prepareGame();
        $game->getBoardService()->addMoveToBoard(new Move('player', 1, 1));

        $move = new Move('player', 1, 1);

        $isProperBoardMove = new IsProperBoardMove($game);
        self::assertFalse($isProperBoardMove->isSatisfiedBy($move));
    }

    public function testShouldReturnTrueForEmptySpaceOnBoard(): void
    {
        $game = $this->prepareGame();
        $game->getBoardService()->addMoveToBoard(new Move('player', 0, 0));
        $game->getBoardService()->addMoveToBoard(new Move('player', 0, 2));

        $move = new Move('player', 0, 1);

        $isProperBoardMove = new IsProperBoardMove($game);
        self::assertTrue($isProperBoardMove->isSatisfiedBy($move));
    }
}
