<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Services;

use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use PHPUnit\Framework\TestCase;

class PlayersServiceTest extends TestCase
{
    public function testShouldGetFirstPlayerOnTurn(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playersService = new PlayerService($first, $second);

        $actual = $playersService->getActivePlayer();
        self::assertEquals($first, $actual);
    }

    public function testShouldGetSecondPlayerOnTurnAfterSwitch(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playersService = new PlayerService($first, $second);

        $playersService->switchActivePlayer();

        $actual = $playersService->getActivePlayer();
        self::assertEquals($second, $actual);
    }

    public function testShouldGetSecondPlayerOnTurnAfterDoubleSwitch(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playersService = new PlayerService($first, $second);

        $playersService->switchActivePlayer();
        $playersService->switchActivePlayer();

        $actual = $playersService->getActivePlayer();
        self::assertEquals($first, $actual);
    }

    public function testShouldIncrementActivePlayerScore(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playersService = new PlayerService($first, $second);

        $firstPlayer = $playersService->getActivePlayer();
        self::assertEquals(0, $firstPlayer->getScore());

        $playersService->proclaimActivePlayerWin();
        $firstPlayer = $playersService->getActivePlayer();
        self::assertEquals(1, $firstPlayer->getScore());
    }

    public function testShouldIncrementTwiceBothPlayersScore(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playersService = new PlayerService($first, $second);

        $playersService->proclaimActivePlayerWin();
        $playersService->proclaimActivePlayerWin();

        $firstPlayer = $playersService->getActivePlayer();
        self::assertEquals(2, $firstPlayer->getScore());

        $playersService->switchActivePlayer();
        $playersService->proclaimActivePlayerWin();
        $playersService->proclaimActivePlayerWin();

        $secondPlayer = $playersService->getActivePlayer();
        self::assertEquals(2, $secondPlayer->getScore());
    }
}
