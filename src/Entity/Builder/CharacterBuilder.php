<?php

namespace App\Entity\Builder;

use App\Entity\Character;

/**
 * Class CharacterBuilder
 * @package App\Entity\Builder
 */
class CharacterBuilder implements BuilderInterface
{

    public function build(array $data)
    {
        $thumbnailBuilder = new ThumbnailBuilder();
        $thumbnail        = $thumbnailBuilder->build($data);

        $comics = [];
        $comics["available"] = $data["comics"]["available"];

        if ($comics["available"] > 0) {
            $comics["collectionURI"] = $data["comics"]["collectionURI"];
        }

        $stories = [];
        $stories["available"] = $data["stories"]["available"];

        if ($stories["available"] > 0) {
            $stories["collectionURI"] = $data["stories"]["collectionURI"];
        }

        return new Character(
            $data["id"],
            $data["name"],
            $data["description"],
            $data["resourceURI"],
            $thumbnail,
            $comics,
            $stories
        );
    }
}