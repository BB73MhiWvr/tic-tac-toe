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
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $alternateBegins = new AlternatelyBegins($playerService);

        $alternateBegins->choose($playerService);
        self::assertEquals($secondPlayer, $playerService->getActivePlayer());
    }

    public function testShouldNotSwitchToFirstPlayerWhenSecondIsActiveAndFirstStartedCurrentRound(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $alternateBegins = new AlternatelyBegins($playerService);

        $playerService->switchActivePlayer();
        $alternateBegins->choose($playerService);
        self::assertEquals($secondPlayer, $playerService->getActivePlayer());
    }

    public function testShouldSwitchToFirstPlayerWhenSecondIsActiveAndSecondStartedCurrent(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $playerService->switchActivePlayer();
        $alternateBegins = new AlternatelyBegins($playerService);

        $alternateBegins->choose($playerService);
        self::assertEquals($firstPlayer, $playerService->getActivePlayer());
    }

    public function testShouldNotSwitchToSecondPlayerWhenFirstIsActiveAndSecondStartedCurrent(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);
        $playerService->switchActivePlayer();
        $alternateBegins = new AlternatelyBegins($playerService);

        $playerService->switchActivePlayer();
        $alternateBegins->choose($playerService);
        self::assertEquals($firstPlayer, $playerService->getActivePlayer());
    }
}
