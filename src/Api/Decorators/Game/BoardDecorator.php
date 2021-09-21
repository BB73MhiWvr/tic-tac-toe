<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

use TicTacToe\Entities\Game;
use TicTacToe\Entities\Move;

class BoardDecorator extends AbstractDecorator
{
    private const BOARD_NAME = 'board';
    private const EMPTY_BOARD_PIECE = ' ';

    public function decorate(Game $game): array
    {
        $data = $this->decorator->decorate($game);

        $boardSize = $game->getBoardService()->getBoardSize();
        $board = $this->prepareCleanBoard($boardSize);

        $moves = [];
        /** @var Move $move */
        foreach ($game->getBoardService()->getMoves() as $move) {
            $moves[$move->getRow()][$move->getColumn()] = $move->getPlayerId();
        }

        $data[self::BOARD_NAME] = array_replace_recursive($board, $moves);

        return $data;
    }

    private function prepareCleanBoard(int $boardSize): array
    {
        if ($boardSize < 0) {
            return [];
        }

        return array_fill(
            0,
            $boardSize,
            array_fill(
                0,
                $boardSize,
                self::EMPTY_BOARD_PIECE
            )
        );
    }
}
