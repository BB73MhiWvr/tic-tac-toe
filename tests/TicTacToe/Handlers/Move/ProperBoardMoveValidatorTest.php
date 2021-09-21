<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers\Move;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareMoveSpecificationsTrait;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Exceptions\ImproperBoardMoveException;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Handlers\Move\ProperBoardMoveValidator;

class ProperBoardMoveValidatorTest extends TestCase
{
    use PrepareMoveSpecificationsTrait;

    /**
     * @throws MoveException
     */
    public function testShouldThrowExceptionOnNotFulfilledCondition(): void
    {
        $boardMoveValidator = new ProperBoardMoveValidator($this->prepareNotFulfilledMoveSpecification());

        self::expectException(ImproperBoardMoveException::class);
        $boardMoveValidator->validate(new Move(new Player('player'), 0 ,0));
    }

    /**
     * @throws MoveException
     */
    public function testShouldNotThrowExceptionOnFulfilledCondition(): void
    {
        $boardMoveValidator = new ProperBoardMoveValidator($this->prepareFulfilledMoveSpecification());

        $boardMoveValidator->validate(new Move(new Player('player'), 0 ,0));
        self::assertTrue(true);
    }
}
