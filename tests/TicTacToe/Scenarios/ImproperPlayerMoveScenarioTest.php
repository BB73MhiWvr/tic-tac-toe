<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use TicTacToe\Exceptions\ImproperPlayerMoveException;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\TicTacToe;

class ImproperPlayerMoveScenarioTest extends AbstractScenario
{
    /**
     * @throws MoveException
     */
    public function testShouldThrowImproperPlayerMoveException(): void
    {
        self::expectException(ImproperPlayerMoveException::class);
        $this->ticTacToe->registerMove('o', 2, 2);
    }

    /**
     * @throws MoveException
     */
    protected function prepareGameScenario(): void
    {
        $this->ticTacToe = new TicTacToe('x', 'o', new LooserBegins());

        $this->ticTacToe->registerMove('x', 0, 0);
        $this->ticTacToe->registerMove('o', 1, 1);
    }
}
