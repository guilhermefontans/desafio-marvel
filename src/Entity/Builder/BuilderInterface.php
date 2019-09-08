<?php

namespace App\Entity\Builder;

/**
 * Interface BuilderInterface
 * @package App\Entity\Builder
 */
interface BuilderInterface
{
    /**
     * Create a new object
     * @return mixed
     */
    public function build();
}