<?php

namespace App\Entity;

/**
 * Class Character
 * @package App\Entity
 */
class Character
{
    public $id;

    public $name;

    public $description;

    public $modified;

    public $thumbnail;

    public $resourceURI;

    /**
     * Character constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $modified
     * @param $thumbnail
     * @param $resourceURI
     */
    public function __construct($id, $name, $description, $modified, $thumbnail, $resourceURI)
    {
        $this->id           = $id;
        $this->name         = $name;
        $this->description  = $description;
        $this->modified     = $modified;
        $this->thumbnail    = $thumbnail;
        $this->resourceURI  = $resourceURI;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->getName();
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
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
    public function getResourceURI()
    {
        return $this->resourceURI;
    }
}