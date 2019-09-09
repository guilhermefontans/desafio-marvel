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
                "nameStartsWith" => $startOfTheName,
                "limit"          => 1
            ]
        );
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);

        $response = $this->cache->getItem($this->resource . $startOfTheName);
        if (! $response->isHit()) {
            $this->logger->info("Salvando retorno do request em cache [$this->urlFull]", [get_called_class()]);
            $response->set($this->httpclient->request("GET", $this->urlFull)->getContent());
            $this->cache->save($response);
        } else {
            $this->logger->info("Buscando retorno do request em cache [$this->urlFull]", [get_called_class()]);
        }
        $response = $this->cache->getItem($this->resource . $startOfTheName);
        return $response->get();
    }
}