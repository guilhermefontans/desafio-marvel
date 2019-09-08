<?php

namespace App\Entity;

/**
 * Class Comic
 * @package App\Entity
 */
class Comic implements EntityInterface
{
    private $id;

    private $title;

    private $issueNumber;

    private $variantDescription;

    private $description;

    private $thumbnail;

    private $resourceURI;

    private $pageCount;

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
        $this->id                 = $id;
        $this->title              = $title;
        $this->issueNumber        = $issueNumber;
        $this->variantDescription = $variantDescription;
        $this->description        = $description;
        $this->thumbnail          = $thumbnail;
        $this->resourceURI        = $resourceURI;
        $this->pageCount          = $pageCount;
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
    public function getIssueNumber()
    {
        return $this->issueNumber;
    }

    /**
     * @return mixed
     */
    public function getVariantDescription()
    {
        return $this->variantDescription;
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
    public function getPageCount()
    {
        return $this->pageCount;
    }
}