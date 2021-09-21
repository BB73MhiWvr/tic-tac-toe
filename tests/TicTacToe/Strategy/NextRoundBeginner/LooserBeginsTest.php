<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Strategy\NextRoundBeginner;

use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use PHPUnit\Framework\TestCase;

class LooserBeginsTest extends TestCase
{
    public function testShouldSwitchToSecondPlayer(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $looserBegins = new LooserBegins();

        $looserBegins->choose($playerService);
        self::assertEquals($secondPlayer, $playerService->getActivePlayer());
    }

    public function testShouldSwitchToFirstPlayer(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $looserBegins = new LooserBegins();

        $playerService->switchActivePlayer();
        $looserBegins->choose($playerService);
        self::assertEquals($firstPlayer, $playerService->getActivePlayer());
    }
}
