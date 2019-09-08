<?php

namespace App\Entity\Builder;

use App\Entity\EntityInterface;

/**
 * Interface BuilderInterface
 * @package App\Entity\Builder
 */
interface BuilderInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function build(array $data): EntityInterface;
}