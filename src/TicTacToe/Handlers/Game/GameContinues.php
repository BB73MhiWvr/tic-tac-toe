<?php
declare(strict_types=1);

namespace TicTacToe\Handlers\Game;

use TicTacToe\Entities\Game;

class GameContinues extends AbstractGameHandler
{
    protected function handleGame(Game $game): Game
    {
        $game->getPlayerService()->switchActivePlayer();

        return $game;
    }
}
