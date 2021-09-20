<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Traits;

use TicTacToe\Entities\Game;
use TicTacToe\Specifications\Game\GameSpecification;

trait PrepareGameSpecificationsTrait
{
    private function prepareFulfilledGameSpecification(): GameSpecification
    {
        return new class implements GameSpecification {
            public function isSatisfiedBy(Game $game): bool
            {
                return true;
            }
        };
    }

    private function prepareNotFulfilledGameSpecification(): GameSpecification
    {
        return new class implements GameSpecification {
            public function isSatisfiedBy(Game $game): bool
            {
                return false;
            }
        };
    }
}
