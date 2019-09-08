<?php

namespace App\Service;

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
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}