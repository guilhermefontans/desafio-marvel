<?php

namespace App\Entity;

/**
 * Class Thumbnail
 * @package App\Entity
 */
class Thumbnail implements EntityInterface
{
    private $path;

    private $imageSize;

    private $extension;

    private $fullPath = null;

    /**
     * Thumbnail constructor.
     * @param $path
     * @param $imageSize
     * @param $extension
     */
    public function __construct($path = null, $imageSize = null , $extension = null)
    {
        $this->path      = $path;
        $this->imageSize = $imageSize;
        $this->extension = $extension;
        $this->fullPath  = $this->path ."/". $this->imageSize .".".$this->extension;
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->fullPath;
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return null
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * @return null
     */
    public function getExtension()
    {
        return $this->extension;
    }
}