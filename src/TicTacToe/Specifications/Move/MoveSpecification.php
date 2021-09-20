<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Move;

use TicTacToe\Entities\Move;

interface MoveSpecification
{
    public function isSatisfiedBy(Move $move): bool;
}
