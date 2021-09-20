<?php
declare(strict_types=1);

namespace Test\TicTacToe\Entities;

use PHPUnit\Framework\TestCase;
use TicTacToe\Entities\Player;

class PlayerTest extends TestCase
{
    public function testShouldReturnPlayerSymbol(): void
    {
        $player = new Player('x');
        self::assertEquals('x', $player->getSymbol());
    }
}
