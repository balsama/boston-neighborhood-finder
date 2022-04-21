<?php

include_once('vendor/autoload.php');

use Balsama\BostonNeighborhoodFinder\Coordinate;

$response = [];
if (!$_POST) {
    http_response_code(400);
    echo '<p>POST a <code>lat</code> and <code>long</code> value to look up tickets.</p><p>Or use <a href="/lookup.php">the form to submit a lat long pair</a>.</p>';
    exit;
}

if (!array_key_exists('lat', $_POST)) {
    http_response_code(400);
    $response['errors'][] = 'You must POST latitude location as form data with `lat` as the key to this script.';
}
if (!array_key_exists('long', $_POST)) {
    http_response_code(400);
    $response['errors'][] = "You must POST longitude location as form data with `long` as the key to this script.";
}
if (array_key_exists('errors', $response)) {
    echo json_encode($response);
    exit;
}

if (!is_float((float) $_POST['lat'])) {
    $response['errors'][] = 'Latitude must be a float between 42.22 and 42.41.';
}
if (!is_float((float) $_POST['long'])) {
    $response['errors'][] = 'Longitude must be a float between -71.20 and -70.8.';
}
if (array_key_exists('errors', $response)) {
    echo json_encode($response);
    exit;
}

if (!Coordinate::isValidBostonLatitude((float) $_POST['lat'])) {
    http_response_code(400);
    $response['errors'][] = 'Latitude must be float between 42.22 and 42.41.';
    $response['additional info'][] = 'The latitude provided appears to be outside of the bounding box for the City of Boston.';
}
if (!Coordinate::isValidBostonLongitude((float) $_POST['long'])) {
    http_response_code(400);
    $response['errors'][] = "Longitude must be float between -71.20 and -70.8.";
    $response['additional info'][] = 'The longitude provided appears to be outside of the bounding box for the City of Boston.';
}
if (array_key_exists('errors', $response)) {
    echo json_encode($response);
    exit;
}

$lat = (float) $_POST['lat'];
$long = (float) $_POST['long'];

$coordinate = new Coordinate($lat, $long);
$neighborhood = $coordinate->getNeighborhood();
$response['neighborhood'] = $neighborhood;

if ($neighborhood === 'neighborhood unknown') {
    http_response_code(404);
    $response['additional info'] = 'If you are certain that these coordinates are in the City of Boston, please file an issue here: https://github.com/balsama/boston-neighborhood-finder/issues';
}

echo json_encode($response);
