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
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $looserBegins = new LooserBegins();

        $looserBegins->choose($playerService);
        self::assertEquals($second, $playerService->getActivePlayer());
    }

    public function testShouldSwitchToFirstPlayer(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $looserBegins = new LooserBegins();

        $playerService->switchActivePlayer();
        $looserBegins->choose($playerService);
        self::assertEquals($first, $playerService->getActivePlayer());
    }
}
