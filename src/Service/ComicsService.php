<?php

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ComicsService
 * @package App\Service
 */
class ComicsService extends AbstractService
{
    /**
     * ComicsService constructor.
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface $cache
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger, CacheItemPoolInterface $cache)
    {
        parent::__construct($logger, $cache);
    }
}