<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Entities\Player;
use TicTacToe\Exceptions\ImproperPlayerException;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\WinnerBegins;
use TicTacToe\TicTacToe;

class ImproperPlayerScenarioTest extends AbstractScenario
{
    /**
     * @throws MoveException
     */
    public function testShouldThrowImproperPlayerException(): void
    {
        self::expectException(ImproperPlayerException::class);
        $this->ticTacToe->registerMove('-', 2, 2);
    }

    /**
     * @throws MoveException
     */
    protected function prepareGameScenario(): void
    {
        $this->ticTacToe = new TicTacToe(
            new Player('x'),
            new Player('o'),
            new WinnerBegins()
        );
        $this->ticTacToe->registerMove('x', 0, 0);
        $this->ticTacToe->registerMove('o', 1, 1);
    }
}
