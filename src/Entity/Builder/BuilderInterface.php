<?php

namespace App\Entity\Builder;

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
    public function build(array $data);
}