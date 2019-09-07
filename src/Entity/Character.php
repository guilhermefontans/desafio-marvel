<?php


namespace App\Entity;

class Character
{
    private $id;

    private $description;

    private $modified;

    private $thumbnail;

    private $resourceURI;

    /**
     * Character constructor.
     * @param $id
     * @param $description
     * @param $modified
     * @param $thumbnail
     * @param $resourceURI
     */
    public function __construct($id, $description, $modified, $thumbnail, $resourceURI)
    {
        $this->id = $id;
        $this->description = $description;
        $this->modified = $modified;
        $this->thumbnail = $thumbnail;
        $this->resourceURI = $resourceURI;
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