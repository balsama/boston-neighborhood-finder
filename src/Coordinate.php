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
            foreach ($neighborhood as $neighborhoodPolygon) {
                if ($neighborhoodPolygon->contains($point)) {
                    return $name;
                }
            }
        }
        return 'neighborhood unknown';
    }

    public static function isValidBostonLatitude(float $latitude): bool
    {
        return self::isNumericInBounds($latitude, 42.22, 42.41);
    }

    public static function isValidBostonLongitude(float $longitude): bool
    {
        return self::isNumericInBounds($longitude, -71.2, -70.8);
    }

    /**
     * Checks if the given value is (1) numeric, and (2) between lower
     * and upper bounds (including the bounds values).
     */
    private static function isNumericInBounds(float $value, float $lower, float $upper): bool
    {
        return !($value < $lower || $value > $upper);
    }
}
