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

    /**
     * Character constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $resourceURI
     * @param null $thumbnail
     * @param $comics
     */
    public function __construct($id, $name, $description, $resourceURI, $thumbnail = null, $comics)
    {
        $this->id           = $id;
        $this->name         = $name;
        $this->description  = $description;
        $this->resourceURI  = $resourceURI;
        $this->thumbnail    = $thumbnail;
        $this->comics       = $comics;
    }
}