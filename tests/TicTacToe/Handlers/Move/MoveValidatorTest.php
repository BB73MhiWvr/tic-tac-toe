<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers\Move;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareMoveSpecificationsTrait;
use TicTacToe\Entities\Move;
use TicTacToe\Exceptions\ImproperBoardMoveException;
use TicTacToe\Exceptions\ImproperPlayerException;
use TicTacToe\Exceptions\ImproperPlayerMoveException;
use TicTacToe\Exceptions\MoveException;
use TicTacToe\Handlers\Move\ProperBoardMoveValidator;
use TicTacToe\Handlers\Move\ProperPlayerMoveValidator;
use TicTacToe\Handlers\Move\ProperPlayerValidator;

class MoveValidatorTest extends TestCase
{
    use PrepareMoveSpecificationsTrait;

    /**
     * @throws MoveException
     */
    public function testShouldNotReturnExceptionForFulfilledConditions(): void
    {
        $moveValidatorChain = new ProperPlayerValidator(
            $this->prepareFulfilledMoveSpecification(),
            new ProperPlayerMoveValidator(
                $this->prepareFulfilledMoveSpecification(),
                new ProperBoardMoveValidator(
                    $this->prepareFulfilledMoveSpecification()
                )
            )
        );

        $moveValidatorChain->validate(new Move('player', 0, 0));
        self::assertTrue(true);
    }

    /**
     * @throws MoveException
     */
    public function testShouldThrowImproperPlayerException(): void
    {
        $moveValidatorChain = new ProperPlayerValidator(
            $this->prepareNotFulfilledMoveSpecification(),
            new ProperPlayerMoveValidator(
                $this->prepareFulfilledMoveSpecification(),
                new ProperBoardMoveValidator(
                    $this->prepareFulfilledMoveSpecification()
                )
            )
        );

        self::expectException(ImproperPlayerException::class);
        $moveValidatorChain->validate(new Move('player', 0, 0));
    }

    /**
     * @throws MoveException
     */
    public function testShouldThrowImproperPlayerMoveException(): void
    {
        $moveValidatorChain = new ProperPlayerValidator(
            $this->prepareFulfilledMoveSpecification(),
            new ProperPlayerMoveValidator(
                $this->prepareNotFulfilledMoveSpecification(),
                new ProperBoardMoveValidator(
                    $this->prepareFulfilledMoveSpecification()
                )
            )
        );

        self::expectException(ImproperPlayerMoveException::class);
        $moveValidatorChain->validate(new Move('player', 0, 0));
    }

    /**
     * @throws MoveException
     */
    public function testShouldThrowImproperBoardException(): void
    {
        $moveValidatorChain = new ProperPlayerValidator(
            $this->prepareFulfilledMoveSpecification(),
            new ProperPlayerMoveValidator(
                $this->prepareFulfilledMoveSpecification(),
                new ProperBoardMoveValidator(
                    $this->prepareNotFulfilledMoveSpecification()
                )
            )
        );

        self::expectException(ImproperBoardMoveException::class);
        $moveValidatorChain->validate(new Move('player', 0, 0));
    }
}
