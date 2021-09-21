<?php
declare(strict_types=1);

namespace Api\Decorators;

use Api\Decorators\Game\BaseDecorator;
use Api\Decorators\Game\BoardDecorator;
use Api\Decorators\Game\CurrentTurnDecorator;
use Api\Decorators\Game\ScoreDecorator;
use Api\Decorators\Game\VictoryDecorator;
use TicTacToe\Entities\Game;

class GameDecorator
{
    public static function format(Game $game): array
    {
        $decorator = new BaseDecorator();
        $decorator = new BoardDecorator($decorator);
        $decorator = new ScoreDecorator($decorator);
        $decorator = new CurrentTurnDecorator($decorator);
        $decorator = new VictoryDecorator($decorator);

        return $decorator->decorate($game);
    }

    public static function formatCurrentTurnOnly(Game $game): array
    {
        $decorator = new BaseDecorator();
        $decorator = new CurrentTurnDecorator($decorator);

        return $decorator->decorate($game);
    }
}
