<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Traits;

use TicTacToe\Entities\Move;
use TicTacToe\Specifications\Move\MoveSpecification;

trait PrepareMoveSpecificationsTrait
{
    private function prepareFulfilledMoveSpecification(): MoveSpecification
    {
        return new class implements MoveSpecification {
            public function isSatisfiedBy(Move $move): bool
            {
                return true;
            }
        };
    }

    private function prepareNotFulfilledMoveSpecification(): MoveSpecification
    {
        return new class implements MoveSpecification {
            public function isSatisfiedBy(Move $move): bool
            {
                return false;
            }
        };
    }
}
