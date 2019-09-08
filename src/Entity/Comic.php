<?php

namespace App\Entity;

/**
 * Class Comic
 * @package App\Entity
 */
class Comic
{
    public $id;

    public $title;

    public $issueNumber;

    public $variantDescription;

    public $description;

    public $thumbnail;

    public $resourceURI;

    public $pageCount;

    /**
     * Comic constructor.
     * @param $id
     * @param $title
     * @param $issueNumber
     * @param $variantDescription
     * @param $description
     * @param $thumbnail
     * @param $resourceURI
     * @param $pageCount
     */
    public function __construct($id, $title, $issueNumber, $variantDescription, $description, $thumbnail = null, $resourceURI, $pageCount)
    {
        $this->id = $id;
        $this->title = $title;
        $this->issueNumber = $issueNumber;
        $this->variantDescription = $variantDescription;
        $this->description = $description;
        $this->thumbnail = $thumbnail;
        $this->resourceURI = $resourceURI;
        $this->pageCount = $pageCount;
    }
}