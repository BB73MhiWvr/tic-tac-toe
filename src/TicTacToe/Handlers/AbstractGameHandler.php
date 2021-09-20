<?php
declare(strict_types=1);

namespace TicTacToe\Handlers;

use TicTacToe\Entities\Game;

abstract class AbstractGameHandler
{
    protected ?AbstractGameHandler $nextGameHandler = null;

    public function __construct(AbstractGameHandler $nextGameHandler = null)
    {
        $this->nextGameHandler = $nextGameHandler;
    }

    abstract protected function handleGame(Game $game): ?Game;

    final public function handle(Game $game): Game
    {
        $handledGame = $this->handleGame($game);

        if (!is_null($handledGame)) {
            return $handledGame;
        }

        if (is_null($this->nextGameHandler)) {
            return $game;
        }

        return $this->nextGameHandler->handle($game);
    }
}
