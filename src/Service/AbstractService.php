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

    private function formatUrl($id = null, $filters = null)
    {
        $this->resource = strtolower(substr((new \ReflectionClass($this))->getShortName(), 0, -7));
        $this->hash = md5($this->timestamp . $this->privateKey . $this->publicKey);

        $filters["apikey"] = $this->publicKey;
        $filters["ts"]     = $this->timestamp;
        $filters["hash"]   = $this->hash;

        $this->urlFull  = $this->url;
        $this->urlFull .= $this->version;
        $this->urlFull .= $this->resource;
        $this->urlFull .= $id ? "/$id" : "";
        $this->urlFull .= "?" .http_build_query($filters);
    }

    public function findAll()
    {
        $this->formatUrl();
        $this->logger->info("Fazendo request para: [$this->urlFull]", compact(["Resource" => self::class]));
        return $this->httpclient->request("GET", $this->urlFull);
    }

    public function findById($id)
    {
        $this->formatUrl($id);
        $this->logger->info("Fazendo request para: [$this->urlFull]");
        return $this->httpclient->request("GET", $this->urlFull);
    }
}