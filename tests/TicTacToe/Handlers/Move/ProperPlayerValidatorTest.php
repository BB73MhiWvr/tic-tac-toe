<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers\Move;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareMoveSpecificationsTrait;
use TicTacToe\Entities\Move;
use TicTacToe\Exceptions\ImproperPlayerException;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Handlers\Move\ProperPlayerValidator;

class ProperPlayerValidatorTest extends TestCase
{
    use PrepareMoveSpecificationsTrait;

    /**
     * @throws MoveException
     */
    public function testShouldThrowExceptionOnNotFulfilledCondition(): void
    {
        $playerMoveValidator = new ProperPlayerValidator($this->prepareNotFulfilledMoveSpecification());

        self::expectException(ImproperPlayerException::class);
        $playerMoveValidator->validate(new Move('player', 0 ,0));
    }

    /**
     * @throws MoveException
     */
    public function testShouldNotThrowExceptionOnFulfilledCondition(): void
    {
        $playerMoveValidator = new ProperPlayerValidator($this->prepareFulfilledMoveSpecification());

        $playerMoveValidator->validate(new Move('player', 0 ,0));
        self::assertTrue(true);
    }
}
