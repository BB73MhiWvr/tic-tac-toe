<?php
declare(strict_types=1);

namespace Test\TicTacToe\Entities;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Player;

class PlayerTest extends TestCase
{
    public function testShouldReturnPlayerId(): void
    {
        $player = new Player('player');
        self::assertEquals('player', $player->getId());
    }
}
