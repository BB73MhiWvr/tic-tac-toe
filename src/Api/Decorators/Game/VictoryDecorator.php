<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

use TicTacToe\Entities\Game;

class VictoryDecorator extends AbstractDecorator
{
    private const VICTORY_NAME = 'victory';
    private const NO_WINNER_PIECE = ' ';
    private const TIED_GAME_PIECE = 'finished';

    public function decorate(Game $game): array
    {
        $data = $this->decorator->decorate($game);

        if ($game->isWon()) {
            $data[self::VICTORY_NAME] = $game->getPlayerService()->getActivePlayer()->getId();
            return $data;
        }

        if ($game->isTied()) {
            $data[self::VICTORY_NAME] = self::TIED_GAME_PIECE;
            return $data;
        }

        $data[self::VICTORY_NAME] = self::NO_WINNER_PIECE;
        return $data;
    }
}
