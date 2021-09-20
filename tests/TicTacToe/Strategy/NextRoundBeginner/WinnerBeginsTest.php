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
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $winnerBegins = new WinnerBegins();

        $winnerBegins->choose($playerService);
        self::assertEquals($first, $playerService->getActivePlayer());
    }

    public function testShouldNotSwitchToFirstPlayer(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $winnerBegins = new WinnerBegins();

        $playerService->switchActivePlayer();
        $winnerBegins->choose($playerService);
        self::assertEquals($second, $playerService->getActivePlayer());
    }
}
