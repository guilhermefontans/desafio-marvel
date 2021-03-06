<?php

namespace App\Entity\Builder;

use App\Entity\Comic;
use App\Entity\EntityInterface;

/**
 * Class ComicBuilder
 * @package App\Entity\Builder
 */
class ComicBuilder implements BuilderInterface
{

    public function build(array $data): EntityInterface
    {
        $thumbnailBuilder = new ThumbnailBuilder();
        $thumbnail        = $thumbnailBuilder->build($data);

        return new Comic(
            $data["id"],
            $data["title"],
            $data["issueNumber"],
            $data["variantDescription"],
            $data["description"],
            $thumbnail,
            $data["resourceURI"],
            $data["pageCount"]
        );
    }
}