<?php

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Class StoriesService
 * @package App\Service
 */
class StoriesService extends AbstractService
{
    /**
     * StoriesService constructor.
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface $cache
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger, CacheItemPoolInterface $cache)
    {
        parent::__construct($logger, $cache);
    }
}