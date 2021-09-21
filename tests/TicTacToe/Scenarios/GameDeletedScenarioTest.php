<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\TicTacToe;

class GameDeletedScenarioTest extends AbstractNewGameScenario
{
    public function testPlayersScoreShouldBeZero(): void
    {
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getFirstPlayer()->getScore());
        self::assertEquals(0, $this->ticTacToe->getGame()->getPlayerService()->getSecondPlayer()->getScore());
    }

    public function testFirstPlayerShouldBeOnTurn(): void
    {
        self::assertSame(
            $this->ticTacToe->getGame()->getPlayerService()->getFirstPlayer(),
            $this->ticTacToe->getGame()->getPlayerService()->getActivePlayer()
        );
    }

    /**
     * @throws MoveException
     */
    protected function prepareGameScenario(): void
    {
        $this->ticTacToe = new TicTacToe('x', 'o', new LooserBegins());

        $this->ticTacToe->registerMove('x', 0, 0);
        $this->ticTacToe->registerMove('o', 0, 1);
        $this->ticTacToe->registerMove('x', 1, 1);
        $this->ticTacToe->registerMove('o', 1, 2);
        $this->ticTacToe->registerMove('x', 2, 2);

        $this->ticTacToe->deleteGame();
    }
}
