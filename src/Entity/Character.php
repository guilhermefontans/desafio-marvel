<?php

namespace App\Entity;

/**
 * Class Character
 * @package App\Entity
 */
class Character implements EntityInterface
{
    private $id;

    private $name;

    private $description;

    private $thumbnail;

    private $resourceURI;

    private $comics;

    private $stories;

    /**
     * Character constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $resourceURI
     * @param null $thumbnail
     * @param $comics
     * @param $stories
     */
    public function __construct($id, $name, $description, $resourceURI, $thumbnail = null, $comics, $stories)
    {
        $this->id           = $id;
        $this->name         = $name;
        $this->description  = $description;
        $this->resourceURI  = $resourceURI;
        $this->thumbnail    = $thumbnail;
        $this->comics       = $comics;
        $this->stories      = $stories;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
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
    public function getComics()
    {
        return $this->comics;
    }

    /**
     * @return mixed
     */
    public function getStories()
    {
        return $this->stories;
    }
}