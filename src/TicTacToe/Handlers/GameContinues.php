<?php
declare(strict_types=1);

namespace TicTacToe\Handlers;

use TicTacToe\Entities\Game;

class GameContinues extends AbstractGameHandler
{
    protected function handleGame(Game $game): Game
    {
        $game->getPlayerService()->switchActivePlayer();

        return $game;
    }
}
