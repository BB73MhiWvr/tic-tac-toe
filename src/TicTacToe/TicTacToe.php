<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Entities\Game;
use TicTacToe\Entities\Player;
use TicTacToe\Handlers\GameHandlerFactory;
use TicTacToe\Strategy\NextRoundBeginner\NextRoundBeginnerStrategy;

class TicTacToe
{
    private Game $game;

    public function __construct(
        Player $firstPlayer,
        Player $secondPlayer,
        NextRoundBeginnerStrategy $nextRoundBeginnerStrategy
    ) {
        $this->game = new Game($firstPlayer, $secondPlayer, $nextRoundBeginnerStrategy);
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function restartGame(): Game
    {
        $this->game->getBoardService()->clearBoard();
        $this->game->setIsTied(false);
        $this->game->setIsWon(false);

        return $this->game;
    }

    public function deleteGame(): Game
    {
        $this->game = new Game(
            $this->game->getPlayerService()->getFirstPlayer(),
            $this->game->getPlayerService()->getSecondPlayer(),
            $this->game->getNextRoundBeginnerStrategy()
        );

        return $this->game;
    }

    public function registerMove(string $playerSymbol, int $column, int $row): Game
    {
        
        $this->game = (new GameHandlerFactory())->createHandlersChain()->handle($this->game);

        return $this->game;
    }
}
