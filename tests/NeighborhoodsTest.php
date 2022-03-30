<?php

class NeighborhoodsTest extends \PHPUnit\Framework\TestCase

{

    private \Balsama\BostonNeighborhoodFinder\Neighborhoods $neighborhoods;

    protected function setUp(): void
    {
        parent::setUp();
        $this->neighborhoods = new \Balsama\BostonNeighborhoodFinder\Neighborhoods();
    }

    public function testGetNeighborhoods()
    {
        $neighborhoods = $this->neighborhoods->getNeighborhoods();
        $this->assertCount(26, $neighborhoods);
        $this->assertIsArray($neighborhoods['Roslindale']);
        $this->assertIsArray($neighborhoods['Jamaica Plain']);

        foreach ($neighborhoods['East Boston'] as $polygon) {
            $this->assertInstanceOf('\Location\Polygon', $polygon);
        }
        foreach ($neighborhoods['Dorchester'] as $polygon) {
            $this->assertInstanceOf('\Location\Polygon', $polygon);
        }

    }

}