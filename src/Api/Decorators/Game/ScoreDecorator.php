<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

use TicTacToe\Entities\Game;

class ScoreDecorator extends AbstractDecorator
{
    private const SCORE_NAME = 'score';

    public function decorate(Game $game): array
    {
        $data = $this->decorator->decorate($game);

        $firstPlayer = $game->getPlayerService()->getFirstPlayer();
        $secondPlayer = $game->getPlayerService()->getSecondPlayer();

        $data[self::SCORE_NAME] = [
            $firstPlayer->getId() => $firstPlayer->getScore(),
            $secondPlayer->getId() => $secondPlayer->getScore(),
        ];

        return $data;
    }
}
