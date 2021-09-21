<?php
declare(strict_types=1);

namespace TicTacToe\Handlers\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Exceptions\ImproperPlayerException;
use TicTacToe\Specifications\Move\MoveSpecification;

class ProperPlayerValidator extends AbstractMoveValidator
{
    private MoveSpecification $moveSpecification;

    public function __construct(MoveSpecification $moveSpecification, ?AbstractMoveValidator $nextMoveValidator = null)
    {
        $this->moveSpecification = $moveSpecification;
        parent::__construct($nextMoveValidator);
    }

    protected function validateMove(Move $move): void
    {
        if (!$this->moveSpecification->isSatisfiedBy($move)) {
            throw new ImproperPlayerException();
        }
    }
}