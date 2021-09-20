<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use TicTacToe\Specifications\Move\IsProperPlayerMove;
use PHPUnit\Framework\TestCase;

class IsProperPlayerMoveTest extends TestCase
{
    public function testShouldReturnFalseWhenNotActivePlayerAddsMove(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);

        $isProperPlayerMove = new IsProperPlayerMove($playerService);
        $move = new Move($playerService->getActivePlayer(), 1, 1);

        $playerService->switchActivePlayer();
        self::assertFalse($isProperPlayerMove->isSatisfiedBy($move));
    }

    public function testShouldReturnTrueWhenActivePlayerAddsMove(): void
    {
        $first = new Player('first');
        $second = new Player('second');
        $playerService = new PlayerService($first, $second);

        $isProperPlayerMove = new IsProperPlayerMove($playerService);
        $move = new Move($playerService->getActivePlayer(), 1, 1);

        self::assertTrue($isProperPlayerMove->isSatisfiedBy($move));
    }
}
