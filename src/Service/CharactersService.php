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
}