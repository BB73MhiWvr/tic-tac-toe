<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Entities\Game;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Handlers\Game\GameHandlerFactory;
use TicTacToe\Handlers\Move\MoveValidatorFactory;
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
            new Player($this->game->getPlayerService()->getFirstPlayer()->getId()),
            new Player($this->game->getPlayerService()->getSecondPlayer()->getId()),
            $this->game->getNextRoundBeginnerStrategy()
        );

        return $this->game;
    }

    /**
     * @throws Exceptions\MoveException
     */
    public function registerMove(string $playerId, int $column, int $row): Game
    {
        $move = new Move($playerId, $column, $row);
        (new MoveValidatorFactory())->createValidatorsChain($this->game)->validate($move);

        $this->getGame()->getBoardService()->addMoveToBoard($move);
        $this->game = (new GameHandlerFactory())->createHandlersChain()->handle($this->game);

        return $this->game;
    }
}
