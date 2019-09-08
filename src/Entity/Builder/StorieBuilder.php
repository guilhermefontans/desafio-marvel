<?php

namespace App\Entity\Builder;

use App\Entity\Storie;

/**
 * Class StorieBuilder
 * @package App\Entity\Builder
 */
class StorieBuilder implements BuilderInterface
{
    private $data;

    /**
     * StorieBuilder constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $thumbnailBuilder = new ThumbnailBuilder($this->data);
        $thumbnail = $thumbnailBuilder->build();

        return new Storie(
            $this->data["id"],
            $this->data["title"],
            $this->data["resourceURI"],
            $thumbnail
        );
    }
}