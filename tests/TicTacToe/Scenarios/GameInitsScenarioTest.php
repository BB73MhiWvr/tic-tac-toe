<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\TicTacToe;

class GameInitsScenarioTest extends AbstractScenario
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

    public function testFirstPlayerShouldBeOnTurn(): void
    {
        self::assertSame(
            $this->ticTacToe->getGame()->getPlayerService()->getFirstPlayer(),
            $this->ticTacToe->getGame()->getPlayerService()->getActivePlayer()
        );
    }

    public function testPlayersScoreShouldBeZero(): void
    {
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getFirstPlayer()->getScore());
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getSecondPlayer()->getScore());
    }

    protected function prepareGameScenario(): void
    {
        $this->ticTacToe = new TicTacToe('x', 'o', new LooserBegins());
    }
}
