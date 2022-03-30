<?php

namespace Balsama\BostonNeighborhoodFinder;

use Location\Coordinate as BaseCoordinate;

class Coordinate
{
    private array $neighborhoods;
    private float $lat;
    private float $long;

    public function __construct(float $lat, float $long)
    {
        $neighborhoods = new Neighborhoods();
        $this->neighborhoods = $neighborhoods->getNeighborhoods();
        $this->lat = $lat;
        $this->long = $long;
    }

    public function getNeighborhood(): string
    {
        $point = new BaseCoordinate($this->long, $this->lat);
        foreach ($this->neighborhoods as $name => $neighborhood) {
            if (!is_array($neighborhood)) {
                if ($neighborhood->contains($point)) {
                    return $name;
                }
            } else {
                // Some neighborhoods are arrays of polygons.
                foreach ($neighborhood as $neighborhoodPolygon) {
                    if ($neighborhoodPolygon->contains($point)) {
                        return $name;
                    }
                }
            }
        }
        return 'neighborhood unknown';
    }
}
