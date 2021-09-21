<?php
declare(strict_types=1);

namespace Api\Configuration;

use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;
use TicTacToe\Strategy\NextRoundBeginner\NextRoundBeginnerStrategy;

class GameConfiguration
{
    private const FIRST_PLAYER_ID = 'x';
    private const SECOND_PLAYER_ID = 'o';

    private const GAME_CACHE_KEY = 'cache-key';

    public function getFirstPlayerId(): string
    {
        return self::FIRST_PLAYER_ID;
    }

    public function getSecondPlayerId(): string
    {
        return self::SECOND_PLAYER_ID;
    }

    public function getNextRoundBeginnerStrategy(): NextRoundBeginnerStrategy
    {
        return new LooserBegins();
    }

    public function getGameCacheKey(): string
    {
        return self::GAME_CACHE_KEY;
    }

    public function getGameCacheAdapter(): AbstractAdapter
    {
        return new FilesystemAdapter();
    }
}
