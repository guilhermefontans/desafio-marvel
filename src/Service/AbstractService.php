<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Class AbstractService
 * @package App\Service
 */
class AbstractService
{
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
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpclient = HttpClient::create();
        $this->privateKey = $_ENV["API_PRIVATE_KEY"];
        $this->publicKey = $_ENV["API_PUBLIC_KEY"];
        $now = new \DateTimeImmutable();
        $this->timestamp = $now->getTimestamp();
        $this->formatUrl();
    }

    public function formatUrl()
    {
        $this->resource = strtolower(substr((new \ReflectionClass($this))->getShortName(), 0, -7));
        $this->hash = md5($this->timestamp . $this->privateKey . $this->publicKey);
        $parameters = [
            "apikey" => $this->publicKey,
            "ts" => $this->timestamp,
            "hash" => $this->hash
        ];

        $this->urlFull  = $this->url;
        $this->urlFull .= $this->version;
        $this->urlFull .= $this->resource;
        $this->urlFull .= "?" .http_build_query($parameters);
    }

    public function request()
    {
        return $this->httpclient->request("GET", $this->urlFull);
    }
}