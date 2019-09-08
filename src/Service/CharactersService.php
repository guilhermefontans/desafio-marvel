<?php

namespace App\Service;

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
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
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
        return $this->httpclient->request("GET", $this->urlFull);
    }
}