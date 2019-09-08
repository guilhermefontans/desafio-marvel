<?php

namespace App\Service;

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

    /**
     * AbstractService constructor.
     * @param LoggerInterface $logger
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger       = $logger;
        $this->httpclient   = HttpClient::create();
        $this->privateKey   = $_ENV["API_PRIVATE_KEY"];
        $this->publicKey    = $_ENV["API_PUBLIC_KEY"];
        $now                = new \DateTimeImmutable();
        $this->timestamp    = $now->getTimestamp();
    }

    private function formatUrlFull($id = null, $filters = null, $resource = null)
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
        return $this->httpclient->request("GET", $this->urlFull);
    }

    public function findByResourceURI($resourceUri)
    {
        $this->formatUrlFull(null, null, $resourceUri);
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);
        return $this->httpclient->request("GET", $this->urlFull);
    }

    public function findById($id)
    {
        $this->formatUrlFull($id);
        $this->logger->info("Fazendo request para: [$this->urlFull]", [get_called_class()]);
        return $this->httpclient->request("GET", $this->urlFull);
    }
}