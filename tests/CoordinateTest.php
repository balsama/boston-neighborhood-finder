<?php

class CoordinateTest extends \PHPUnit\Framework\TestCase
{

    public function testGetNeighborhood()
    {
        $southend = new \Balsama\BostonNeighborhoodFinder\Coordinate('-71.0745', '42.3454');
        $this->assertEquals('South End', $southend->getNeighborhood());

        $eastboston = new \Balsama\BostonNeighborhoodFinder\Coordinate('-71.0101', '42.3889');
        $this->assertEquals('East Boston', $eastboston->getNeighborhood());

        $dorchester = new \Balsama\BostonNeighborhoodFinder\Coordinate('-71.0657', '42.319');
        $this->assertEquals('Dorchester', $dorchester->getNeighborhood());
    }

}