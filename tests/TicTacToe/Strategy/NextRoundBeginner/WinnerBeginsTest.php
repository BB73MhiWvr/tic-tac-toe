<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Strategy\NextRoundBeginner;

use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use TicTacToe\Strategy\NextRoundBeginner\WinnerBegins;
use PHPUnit\Framework\TestCase;

class WinnerBeginsTest extends TestCase
{
    public function testShouldNotSwitchToSecondPlayer(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $winnerBegins = new WinnerBegins();

        $winnerBegins->choose($playerService);
        self::assertEquals($firstPlayer, $playerService->getActivePlayer());
    }

    public function testShouldNotSwitchToFirstPlayer(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $winnerBegins = new WinnerBegins();

        $playerService->switchActivePlayer();
        $winnerBegins->choose($playerService);
        self::assertEquals($secondPlayer, $playerService->getActivePlayer());
    }
}
