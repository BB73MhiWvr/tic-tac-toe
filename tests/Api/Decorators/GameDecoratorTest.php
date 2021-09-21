<?php
declare(strict_types=1);

namespace Tests\Api\Decorators;

use Api\Decorators\GameDecorator;
use PHPUnit\Framework\TestCase;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\Strategy\NextRoundBeginner\WinnerBegins;
use TicTacToe\TicTacToe;

class GameDecoratorTest extends TestCase
{
    public function testShouldReturnFormattedCleanGame(): void
    {
        $ticTacToe = new TicTacToe('x', 'o', new LooserBegins());
        $game = $ticTacToe->getGame();

        $expected = [
            'board' => [[' ', ' ',' '], [' ', ' ',' '], [' ', ' ',' ']],
            'score' => ['x' => 0, 'o' => 0],
            'currentTurn' => 'x',
            'victory' => ' '
        ];
        self::assertEquals($expected, GameDecorator::format($game));
    }

    /**
     * @throws MoveException
     */
    public function testShouldReturnFormattedGameInProgress(): void
    {
        $ticTacToe = new TicTacToe('x', 'o', new LooserBegins());
        $ticTacToe->registerMove('x', 0, 0);
        $ticTacToe->registerMove('o', 0, 1);
        $ticTacToe->registerMove('x', 0, 2);

        $game = $ticTacToe->getGame();

        $expected = [
            'board' => [['x', ' ', ' '], ['o', ' ', ' '], ['x', ' ', ' ']],
            'score' => ['x' => 0, 'o' => 0],
            'currentTurn' => 'o',
            'victory' => ' '
        ];
        self::assertEquals($expected, GameDecorator::format($game));
    }

    /**
     * @throws MoveException
     */
    public function testShouldReturnFormattedTiedGame(): void
    {
        $ticTacToe = new TicTacToe('x', 'o', new LooserBegins());
        $ticTacToe->registerMove('x', 0, 0);
        $ticTacToe->registerMove('o', 1, 1);
        $ticTacToe->registerMove('x', 2, 2);
        $ticTacToe->registerMove('o', 0, 1);
        $ticTacToe->registerMove('x', 0, 2);
        $ticTacToe->registerMove('o', 1, 2);
        $ticTacToe->registerMove('x', 1, 0);
        $ticTacToe->registerMove('o', 2, 0);
        $ticTacToe->registerMove('x', 2, 1);

        $game = $ticTacToe->getGame();

        $expected = [
            'board' => [['x', 'x', 'o'], ['o', 'o', 'x'], ['x', 'o', 'x']],
            'score' => ['x' => 0, 'o' => 0],
            'currentTurn' => 'o',
            'victory' => 'finished'
        ];
        self::assertEquals($expected, GameDecorator::format($game));
    }

    /**
     * @throws MoveException
     */
    public function testShouldReturnFormattedWonGame(): void
    {
        $ticTacToe = new TicTacToe('x', 'o', new WinnerBegins());
        $ticTacToe->registerMove('x', 0, 0);
        $ticTacToe->registerMove('o', 1, 0);
        $ticTacToe->registerMove('x', 1, 1);
        $ticTacToe->registerMove('o', 2, 0);
        $ticTacToe->registerMove('x', 2, 2);

        $game = $ticTacToe->getGame();


        $expected = [
            'board' => [['x', 'o', 'o'], [' ', 'x', ' '], [' ', ' ', 'x']],
            'score' => ['x' => 1, 'o' => 0],
            'currentTurn' => 'x',
            'victory' => 'x'
        ];
        self::assertEquals($expected, GameDecorator::format($game));
    }

    public function testShouldReturnFormattedCurrentTurn(): void
    {
        $game = (new TicTacToe('x', 'o', new LooserBegins()))->getGame();

        $expected = ['currentTurn' => 'x'];
        self::assertEquals($expected, GameDecorator::formatCurrentTurnOnly($game));
    }
}
