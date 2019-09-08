<?php

namespace App\Entity;

/**
 * Class Thumbnail
 * @package App\Entity\Builder
 */
class Thumbnail
{
    public $path;

    public $imageSize;

    public $extension;

    public $fullPath;

    /**
     * Thumbnail constructor.
     * @param $path
     * @param $imageSize
     * @param $extension
     */
    public function __construct($path, $imageSize, $extension)
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
}