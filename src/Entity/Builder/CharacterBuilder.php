<?php

namespace App\Entity\Builder;

use App\Entity\Character;

/**
 * Class CharacterBuilder
 * @package App\Entity\Builder
 */
class CharacterBuilder implements BuilderInterface
{
    private $data;
    /**
     * CharacterBuilder constructor.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $thumbnailBuilder = new ThumbnailBuilder($this->data);
        $thumbnail = $thumbnailBuilder->build();

        $comics = [];
        $comics["available"] = $this->data["comics"]["available"];

        if ($comics["available"] > 0) {
            foreach ($this->data["comics"]["items"] as $item) {
                $comics["items"][] = $item;
            }
        }

        return new Character(
            $this->data["id"],
            $this->data["name"],
            $this->data["description"],
            $this->data["resourceURI"],
            $thumbnail,
            $comics
        );
    }
}