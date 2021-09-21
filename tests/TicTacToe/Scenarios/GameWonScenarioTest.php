<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Entities\Player;
use TicTacToe\Exceptions\ImproperBoardMoveException;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\TicTacToe;

class GameWonScenarioTest extends AbstractScenario
{
    public function testGameShouldBeWon(): void
    {
        self::assertTrue($this->ticTacToe->getGame()->isWon());
    }

    public function testGameShouldNotBeTied(): void
    {
        self::assertFalse($this->ticTacToe->getGame()->isTied());
    }

    public function testBoardShouldNotBeEmpty(): void
    {
        self::assertNotEmpty($this->ticTacToe->getGame()->getBoardService()->getMoves());
    }

    public function testWinnerScoreShouldBeIncremented(): void
    {
        self::assertEquals(1, $this->ticTacToe->getGame()->getPlayerService()->getSecondPlayer()->getScore());
    }

    public function testLooserScoreShouldNotBeIncremented(): void
    {
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getFirstPlayer()->getScore());
    }

    /**
     * @throws MoveException
     */
    public function testMoveOnWonGameShouldThrowException(): void
    {
        self::expectException(ImproperBoardMoveException::class);
        $this->ticTacToe->registerMove('x', 0, 2);
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
        $this->ticTacToe->registerMove('o', 1, 0);
        $this->ticTacToe->registerMove('x', 2, 2);
        $this->ticTacToe->registerMove('o', 1, 1);
        $this->ticTacToe->registerMove('x', 0, 1);
        $this->ticTacToe->registerMove('o', 1, 2);
    }
}
