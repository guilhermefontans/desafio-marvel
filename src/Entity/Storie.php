<?php

namespace App\Entity;

/**
 * Class Storie
 * @package App\Entity
 */
class Storie
{
    public $id;

    public $title;

    public $resourceURI;

    public $thumbnail;

    /**
     * Storie constructor.
     * @param $id
     * @param $title
     * @param $resourceURI
     * @param $thumbnail
     */
    public function __construct($id, $title, $resourceURI, $thumbnail)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->resourceURI = $resourceURI;
        $this->thumbnail   = $thumbnail;
    }

}