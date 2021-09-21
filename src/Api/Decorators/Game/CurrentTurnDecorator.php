<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

use TicTacToe\Entities\Game;

class CurrentTurnDecorator extends AbstractDecorator
{
    private const CURRENT_TURN_NAME = 'currentTurn';

    public function decorate(Game $game): array
    {
        $data = $this->decorator->decorate($game);

        $data[self::CURRENT_TURN_NAME] = $game->getPlayerService()->getActivePlayer()->getId();

        return $data;
    }
}
