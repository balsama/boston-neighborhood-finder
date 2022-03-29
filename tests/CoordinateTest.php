<?php

class CoordinateTest extends \PHPUnit\Framework\TestCase
{

    public function testGetNeighborhood()
    {
        $southend = new \Balsama\BostonNeighborhoodFinder\Coordinate('42.3454', '-71.0745');
        $this->assertEquals('South End', $southend->getNeighborhood());

        $eastboston = new \Balsama\BostonNeighborhoodFinder\Coordinate('42.3889', '-71.0101');
        $this->assertEquals('East Boston', $eastboston->getNeighborhood());

        $dorchester = new \Balsama\BostonNeighborhoodFinder\Coordinate('42.319', '-71.0657');
        $this->assertEquals('Dorchester', $dorchester->getNeighborhood());
    }

}