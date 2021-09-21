<?php
declare(strict_types=1);

namespace Api\Services;

use Api\Configuration\GameConfiguration;
use Api\Exceptions\GameServiceCacheException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\CacheItem;
use TicTacToe\TicTacToe;

class GameService
{
    private GameConfiguration $configuration;

    public function __construct(GameConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @throws GameServiceCacheException
     */
    public function getTicTacToe(): TicTacToe
    {
        $cacheItem = $this->getCacheItem();

        /** @var TicTacToe | null $cachedInstance */
        $cachedInstance = $cacheItem->get();
        if ($cachedInstance instanceof TicTacToe) {
            return $cachedInstance;
        }

        $newInstance = new TicTacToe(
            $this->configuration->getFirstPlayerId(),
            $this->configuration->getSecondPlayerId(),
            $this->configuration->getNextRoundBeginnerStrategy()
        );
        $this->saveTicTacToe($newInstance);

        return $newInstance;
    }

    /**
     * @throws GameServiceCacheException
     */
    public function saveTicTacToe(TicTacToe $ticTacToe): void
    {
        $cacheItem = $this->getCacheItem();
        $cacheItem->set($ticTacToe);
        $this->configuration->getGameCacheAdapter()->save($cacheItem);
    }

    /**
     * @throws GameServiceCacheException
     */
    private function getCacheItem(): CacheItem
    {
        try {
            $cacheItem = $this->configuration->getGameCacheAdapter()->getItem(
                $this->configuration->getGameCacheKey()
            );
        } catch (InvalidArgumentException) {
            throw new GameServiceCacheException();
        }

        return $cacheItem;
    }
}
