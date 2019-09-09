<?php

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class AbstractService
 * @package App\Service
 */
class AbstractService
{
    protected $logger;

    protected $httpclient;

    protected $url = "https://gateway.marvel.com/";

    protected $version = "v1/public/";

    protected $resource;

    protected $publicKey;

    protected $privateKey;

    protected $hash;

    protected $timestamp;

    protected $urlFull;

    protected $filters;

    protected $cache;

    /**
     * AbstractService constructor.
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface $cache
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger, CacheItemPoolInterface $cache)
    {
        $this->logger       = $logger;
        $this->httpclient   = HttpClient::create();
        $this->privateKey   = $_ENV["API_PRIVATE_KEY"];
        $this->publicKey    = $_ENV["API_PUBLIC_KEY"];
        $now                = new \DateTimeImmutable();
        $this->timestamp    = $now->getTimestamp();
        $this->cache        = $cache;

        if ($this->privateKey == "xxxxxxxx") {
            throw new \Exception("Did you edit .env file?");
        }
    }

    protected function formatUrlFull($id = null, $filters = null, $resource = null)
    {
        $this->urlFull = $resource;
        if (is_null($resource)) {
            $this->createURLResource();
        }
        $this->mountFilters($id, $filters);
    }

    private function createURLResource()
    {
        $this->resource = strtolower(substr((new \ReflectionClass($this))->getShortName(), 0, -7));
        $this->urlFull  = $this->url;
        $this->urlFull .= $this->version;
        $this->urlFull .= $this->resource;
    }

    private function mountFilters($id = null, $filters = null)
    {
        $this->hash        = md5($this->timestamp . $this->privateKey . $this->publicKey);
        $filters["apikey"] = $this->publicKey;
        $filters["ts"]     = $this->timestamp;
        $filters["hash"]   = $this->hash;
        $this->urlFull    .= $id ? "/$id" : "";
        $this->urlFull    .= "?" .http_build_query($filters);
    }

    public function findAll()
    {
        $this->formatUrlFull();
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);

        $response = $this->cache->getItem($this->urlFull);
        if (! $response->isHit()) {
            $this->logger->info("Salvando retorno do request em cache [$this->urlFull]", [get_called_class()]);
            $response->set($this->httpclient->request("GET", $this->urlFull));
            $this->cache->save($response);
        } else {
            $this->logger->info("Buscando retorno do request em cache [$this->urlFull]", [get_called_class()]);
        }
        return $this->cache->getItem($this->urlFull);
    }

    public function findByResourceURI($resourceUri)
    {
        $this->formatUrlFull(null, ["limit" => 5], $resourceUri);
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);

        $response = $this->cache->getItem(urlencode($resourceUri));

        if (! $response->isHit()) {
            $this->logger->info("Salvando retorno do request em cache [$this->urlFull]", [get_called_class()]);
            $response->set($this->httpclient->request("GET", $this->urlFull)->getContent());
            $this->cache->save($response);
        } else {
            $this->logger->info("Buscando retorno do request em cache [$this->urlFull]", [get_called_class()]);
        }

        $response = $this->cache->getItem(urlencode($resourceUri));
        return $response->get();
    }

    public function findById($id)
    {
        $this->formatUrlFull($id);
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);

        $response = $this->cache->getItem($this->resource . $id);

        if (! $response->isHit()) {
            $this->logger->info("Salvando retorno do request em cache [$this->urlFull]", [get_called_class()]);
            $response->set($this->httpclient->request("GET", $this->urlFull)->getContent());
            $this->cache->save($response);
        } else {
            $this->logger->info("Buscando retorno do request em cache [$this->urlFull]", [get_called_class()]);
        }
        $response = $this->cache->getItem($this->resource . $id);
        return $response->get();
    }
}