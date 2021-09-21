<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Entities\Player;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\TicTacToe;

class GameContinuesScenarioTest extends AbstractScenario
{
    public function testGameShouldNotBeWon(): void
    {
        self::assertFalse($this->ticTacToe->getGame()->isWon());
    }

    public function testGameShouldNotBeTied(): void
    {
        self::assertFalse($this->ticTacToe->getGame()->isTied());
    }

    public function testBoardShouldNotBeEmpty(): void
    {
        self::assertNotEmpty($this->ticTacToe->getGame()->getBoardService()->getMoves());
    }

    public function testBoardShouldNotBeFilled(): void
    {
        self::assertFalse($this->ticTacToe->getGame()->getBoardService()->isBoardFilled());
    }

    public function testSecondPlayerShouldBeOnTurn(): void
    {
        self::assertSame(
            $this->ticTacToe->getGame()->getPlayerService()->getSecondPlayer(),
            $this->ticTacToe->getGame()->getPlayerService()->getActivePlayer()
        );
    }

    public function testPlayersScoreShouldBeZero(): void
    {
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getFirstPlayer()->getScore());
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getSecondPlayer()->getScore());
    }

    /**
     * @throws MoveException
     */
    protected function prepareGameScenario(): void
    {
        $this->ticTacToe = new TicTacToe(
            new Player('x'),
            new Player('o'),
            new LooserBegins()
        );
        $this->ticTacToe->registerMove('x', 0, 0);
        $this->ticTacToe->registerMove('o', 1, 1);
        $this->ticTacToe->registerMove('x', 2, 2);
    }
}
