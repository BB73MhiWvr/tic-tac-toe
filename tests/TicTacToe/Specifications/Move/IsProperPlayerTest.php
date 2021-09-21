<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use TicTacToe\Specifications\Move\IsProperPlayer;
use PHPUnit\Framework\TestCase;

class IsProperPlayerTest extends TestCase
{
    public function testShouldReturnFalseWhenNotDefinedPlayerAddsMove(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $isProperPlayerMove = new IsProperPlayer($playerService);

        $move = new Move('new player', 1, 1);
        self::assertFalse($isProperPlayerMove->isSatisfiedBy($move));
    }

    public function testShouldReturnTrueWhenDefinedPlayerAddsMove(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $isProperPlayerMove = new IsProperPlayer($playerService);
        $move = new Move('player one', 1, 1);
        self::assertTrue($isProperPlayerMove->isSatisfiedBy($move));

        $move = new Move('player two', 1, 1);
        self::assertTrue($isProperPlayerMove->isSatisfiedBy($move));
    }
}
