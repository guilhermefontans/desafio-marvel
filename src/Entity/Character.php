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

    public $comics;

    public $stories;

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
}