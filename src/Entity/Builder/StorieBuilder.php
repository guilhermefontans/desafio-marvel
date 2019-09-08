<?php

namespace App\Entity\Builder;

use App\Entity\Storie;

/**
 * Class StorieBuilder
 * @package App\Entity\Builder
 */
class StorieBuilder implements BuilderInterface
{
    public function build(array $data)
    {
        $thumbnailBuilder = new ThumbnailBuilder();
        $thumbnail = $thumbnailBuilder->build($data);

        return new Storie(
            $data["id"],
            $data["title"],
            $data["resourceURI"],
            $thumbnail
        );
    }
}