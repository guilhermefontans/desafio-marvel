<?php

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CharactersService
 * @package App\Service
 */
class CharactersService extends AbstractService
{
    /**
     * CharactersService constructor.
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface $cache
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger, CacheItemPoolInterface $cache)
    {
        parent::__construct($logger, $cache);
    }

    public function findByNameStartWith($startOfTheName)
    {
        $this->formatUrlFull(
            null,
            [
                "nameStartsWith" => $startOfTheName
            ]
        );
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);

        return $this->getResponseFromCache($this->resource . $startOfTheName);
    }
}