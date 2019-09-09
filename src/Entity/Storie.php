<?php

namespace App\Entity;

/**
 * Class Storie
 * @package App\Entity
 */
class Storie implements EntityInterface
{
    private $id;

    private $title;

    private $resourceURI;

    private $thumbnail;

    private $description;

    /**
     * Storie constructor.
     * @param $id
     * @param $title
     * @param $resourceURI
     * @param $thumbnail
     * @param $description
     */
    public function __construct($id, $title, $resourceURI, $thumbnail, $description)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->resourceURI = $resourceURI;
        $this->thumbnail   = $thumbnail;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getResourceURI()
    {
        return $this->resourceURI;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
}