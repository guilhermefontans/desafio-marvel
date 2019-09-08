<?php

namespace App\Service;

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
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}