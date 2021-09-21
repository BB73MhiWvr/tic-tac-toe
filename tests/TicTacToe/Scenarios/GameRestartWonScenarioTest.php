<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Entities\Player;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\TicTacToe;

class GameRestartWonScenarioTest extends AbstractNewGameScenario
{
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

        $this->ticTacToe->restartGame();
    }
}
