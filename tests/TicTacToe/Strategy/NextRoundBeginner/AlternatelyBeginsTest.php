<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Strategy\NextRoundBeginner;

use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use TicTacToe\Strategy\NextRoundBeginner\AlternatelyBegins;
use PHPUnit\Framework\TestCase;

class AlternatelyBeginsTest extends TestCase
{
    public function testShouldSwitchToSecondPlayerWhenFirstIsActiveAndFirstStartedCurrentRound(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $alternateBegins = new AlternatelyBegins($playerService);

        $alternateBegins->choose($playerService);
        self::assertEquals($second, $playerService->getActivePlayer());
    }

    public function testShouldNotSwitchToFirstPlayerWhenSecondIsActiveAndFirstStartedCurrentRound(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $alternateBegins = new AlternatelyBegins($playerService);

        $playerService->switchActivePlayer();
        $alternateBegins->choose($playerService);
        self::assertEquals($second, $playerService->getActivePlayer());
    }

    public function testShouldSwitchToFirstPlayerWhenSecondIsActiveAndSecondStartedCurrent(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $playerService->switchActivePlayer();
        $alternateBegins = new AlternatelyBegins($playerService);

        $alternateBegins->choose($playerService);
        self::assertEquals($first, $playerService->getActivePlayer());
    }

    public function testShouldNotSwitchToSecondPlayerWhenFirstIsActiveAndSecondStartedCurrent(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);
        $playerService->switchActivePlayer();
        $alternateBegins = new AlternatelyBegins($playerService);

        $playerService->switchActivePlayer();
        $alternateBegins->choose($playerService);
        self::assertEquals($first, $playerService->getActivePlayer());
    }
}
