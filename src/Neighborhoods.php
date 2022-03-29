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
            if ($rawNeighborhoodFeatures->geometry->type === 'MultiPolygon') {
                $polygons = [];
                foreach ($rawNeighborhoodFeatures->geometry->coordinates as $polygon) {
                    $neighborhoodPolygonN = new Polygon();
                    foreach ($polygon[0] as $coordinate) {
                        $neighborhoodPolygonN->addPoint(new Coordinate($coordinate[0], $coordinate[1]));
                    }
                    $polygons[] = $neighborhoodPolygonN;
                }
                $neighborhoodPolygon = $polygons;
            }
            elseif ($rawNeighborhoodFeatures->geometry->type === 'Polygon') {
                $coordinates = reset($rawNeighborhoodFeatures->geometry->coordinates);
                $neighborhoodPolygon = new Polygon();
                foreach ($coordinates as $coordinate) {
                    $neighborhoodPolygon->addPoint(new Coordinate($coordinate[0], $coordinate[1]));
                }
            }
            $neighborhoods[$rawNeighborhoodFeatures->properties->Name] = $neighborhoodPolygon;
        }
        $this->neighborhoods = $neighborhoods;

    }

    public function getNeighborhoods()
    {
        return $this->neighborhoods;
    }

}