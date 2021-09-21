<?php
declare(strict_types=1);

namespace TicTacToe\Handlers\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Exceptions\MoveException;

abstract class AbstractMoveValidator
{
    protected ?AbstractMoveValidator $nextMoveValidator = null;

    /**
     * @throws MoveException
     */
    abstract protected function validateMove(Move $move): void;

    public function __construct(AbstractMoveValidator $nextMoveValidator = null)
    {
        $this->nextMoveValidator = $nextMoveValidator;
    }

    /**
     * @throws MoveException
     */
    final public function validate(Move $move): void
    {
        $this->validateMove($move);

        if (is_null($this->nextMoveValidator)) {
            return;
        }

        $this->nextMoveValidator->validate($move);
    }
}
