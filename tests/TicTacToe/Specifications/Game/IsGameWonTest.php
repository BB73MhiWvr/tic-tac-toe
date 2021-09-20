<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Game;

use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;
use TicTacToe\Specifications\Game\IsGameWon;
use TicTacToe\Specifications\Game\WinConditions\WinConditionSpecification;
use PHPUnit\Framework\TestCase;

class IsGameWonTest extends TestCase
{
    use PrepareGameTrait;

    public function testShouldReturnTrueForSingleConditionFulfilled(): void
    {
        $isGameWon = new IsGameWon($this->prepareFulfilledCondition());
        self::assertTrue($isGameWon->isSatisfiedBy($this->prepareGame()));
    }

    public function testShouldReturnFalseForSingleConditionNotFulfilled(): void
    {
        $isGameWon = new IsGameWon($this->prepareNotFulfilledCondition());
        self::assertFalse($isGameWon->isSatisfiedBy($this->prepareGame()));
    }

    public function testShouldReturnTrueForOneFulfilledConditionOfMany(): void
    {
        $isGameWon = new IsGameWon(
            $this->prepareFulfilledCondition(),
            $this->prepareNotFulfilledCondition(),
            $this->prepareNotFulfilledCondition(),
        );
        self::assertTrue($isGameWon->isSatisfiedBy($this->prepareGame()));
    }

    public function testShouldReturnTrueForEveryFulfilledConditionOfMany(): void
    {
        $isGameWon = new IsGameWon(
            $this->prepareFulfilledCondition(),
            $this->prepareFulfilledCondition(),
            $this->prepareFulfilledCondition(),
        );
        self::assertTrue($isGameWon->isSatisfiedBy($this->prepareGame()));
    }

    public function testShouldReturnTrueForNoneFulfilledConditionOfMany(): void
    {
        $isGameWon = new IsGameWon(
            $this->prepareNotFulfilledCondition(),
            $this->prepareNotFulfilledCondition(),
            $this->prepareNotFulfilledCondition(),
        );
        self::assertFalse($isGameWon->isSatisfiedBy($this->prepareGame()));
    }

    private function prepareFulfilledCondition(): WinConditionSpecification
    {
        return new class extends WinConditionSpecification {
            public function isSatisfiedBy(BoardService $boardService, Player $player): bool
            {
                return true;
            }
        };
    }

    private function prepareNotFulfilledCondition(): WinConditionSpecification
    {
        return new class extends WinConditionSpecification {
            public function isSatisfiedBy(BoardService $boardService, Player $player): bool
            {
                return false;
            }
        };
    }
}
