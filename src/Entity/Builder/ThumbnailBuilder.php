<?php

namespace App\Entity\Builder;

use App\Entity\EntityInterface;
use App\Entity\Thumbnail;

/**
 * Class ThumbnailBuilder
 * @package App\Entity\Builder
 */
class ThumbnailBuilder implements BuilderInterface
{
    public const IMAGE_VARIANS = [
        "PORTRAIT" => [
            "PORTRAIT_SMALL"        => "portrait_small",
            "PORTRAIT_MEDIUM"       => "portrait_medium",
            "PORTRAIT_XLARGE"       => "portrait_xlarge",
            "PORTRAIT_FANTASTIC"    => "portrait_fantastic",
            "PORTRAIT_UNCANNY"      => "portrait_uncanny",
            "PORTRAIT_INCREDIBLE"   => "portrait_incredible"
        ],
        "STANDARD" => [
            "STANDARD_SMALL"        => "standard_small",
            "STANDARD_MEDIUM"       => "standard_medium",
            "STANDARD_LARGE"        => "standard_large",
            "STANDARD_XLARGE"       => "standard_xlarge",
            "STANDARD_FANTASTIC"    => "standard_fantastic",
            "STANDARD_AMAZING"      => "standard_amazing"
        ],
        "LANDSCAPE" => [
            "LANDSCAPE_SMALL"       => "landscape_small",
            "LANDSCAPE_MEDIUM"      => "landscape_medium",
            "LANDSCAPE_LARGE"       => "landscape_large",
            "LANDSCAPE_XLARGE"      => "landscape_xlarge",
            "LANDSCAPE_AMAZING"     => "landscape_amazing",
            "LANDSCAPE_INCREDIBLE"  => "landscape_incredible",
        ]
    ];

    public function build(array $data): EntityInterface
    {
        $path           = null;
        $extension      = null;
        $hasThumbnail   = true;
        if (is_null($data['thumbnail']) || preg_match("/image_not_available/", $data['thumbnail']['path'])){
            $hasThumbnail = false;
        }

        return new Thumbnail(
            $hasThumbnail ? $data["thumbnail"]["path"] : $path,
            $hasThumbnail ? self::IMAGE_VARIANS["STANDARD"]["STANDARD_FANTASTIC"] : null,
            $hasThumbnail ? $data["thumbnail"]["extension"] : $extension
        );
    }
}