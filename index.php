<?php

include_once('vendor/autoload.php');

use Balsama\BostonNeighborhoodFinder\Coordinate;

if (!$_POST) {
    echo '200 ok<p>POST a <code>lat</code> and <code>long</code> value to look up tickets.</p>';
    exit;
}
if (!$_POST['lat']) {
    throw new Exception('You must provide a latitude as an argument to this script');
}
if (!$_POST['long']) {
    throw new Exception('You must provide a longitude as an argument to this script');
}

$lat = $_POST['lat'];
$long = $_POST['long'];

$coordinate = new Coordinate($lat, $long);
$neighborhood = $coordinate->getNeighborhood();

$response = ['neighborhood' => $neighborhood];

echo json_encode($response);