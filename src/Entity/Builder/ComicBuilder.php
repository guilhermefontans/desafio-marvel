<?php


namespace App\Entity\Builder;


use App\Entity\Comic;

/**
 * Class ComicBuilder
 * @package App\Entity\Builder
 */

class ComicBuilder implements BuilderInterface
{
    private $data;

    /**
     * ComicBuilder constructor.
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

        return new Comic(
            $this->data["id"],
            $this->data["title"],
            $this->data["issueNumber"],
            $this->data["variantDescription"],
            $this->data["description"],
            $thumbnail,
            $this->data["resourceURI"],
            $this->data["pageCount"]
        );
    }
}