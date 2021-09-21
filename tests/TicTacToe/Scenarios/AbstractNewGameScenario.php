<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

abstract class AbstractNewGameScenario extends AbstractScenario
{
    public function testGameShouldNotBeWon(): void
    {
        self::assertFalse($this->ticTacToe->getGame()->isWon());
    }

    public function testGameShouldNotBeTied(): void
    {
        self::assertFalse($this->ticTacToe->getGame()->isTied());
    }

    public function testBoardShouldBeEmpty(): void
    {
        self::assertEmpty($this->ticTacToe->getGame()->getBoardService()->getMoves());
    }
}