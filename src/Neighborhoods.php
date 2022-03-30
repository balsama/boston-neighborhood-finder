<?php

namespace Balsama\BostonNeighborhoodFinder;

use Location\Polygon;
use Location\Coordinate;

class Neighborhoods
{
    private array $neighborhoods;

    public function __construct()
    {
        $bostonGeoJson = json_decode(file_get_contents(__DIR__ . '/../geojson/Boston_Neighborhoods.geojson'));

        foreach ($bostonGeoJson->features as $rawNeighborhoodFeatures) {
            $polygons = [];
            foreach ($rawNeighborhoodFeatures->geometry->coordinates as $polygon) {
                $neighborhoodPolygonN = new Polygon();
                if (count($polygon) === 1) {
                    // Multi-polygon neighborhoods have their coordinates nested one level deeper for some reason.
                    $polygon = reset($polygon);
                }
                foreach ($polygon as $coordinate) {
                    $neighborhoodPolygonN->addPoint(new Coordinate($coordinate[0], $coordinate[1]));
                }
                $polygons[] = $neighborhoodPolygonN;
            }
            $neighborhoodPolygon = $polygons;
            $neighborhoods[$rawNeighborhoodFeatures->properties->Name] = $neighborhoodPolygon;
        }
        $this->neighborhoods = $neighborhoods;
    }

    public function getNeighborhoods()
    {
        return $this->neighborhoods;
    }
}
