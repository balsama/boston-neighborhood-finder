<?php

namespace Balsama\BostonNeighborhoodFinder\Tests;

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
        $this->assertIsArray($neighborhoods['Roslindale']);
        $this->assertCount(26, $neighborhoods);
        $this->assertInstanceOf('\Location\Polygon', $neighborhoods['Leather District']);
    }
}
