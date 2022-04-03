# Boston Neighborhood Finder
Finds what Boston neighborhood a lat/long pair is in.

## Usage
Make an HTTP POST to the provided index.php file. An instance of this runs on Heroku at https://boston-neighborhood-finder.herokuapp.com. A form to POST the data for you can be found here: https://boston-neighborhood-finder.herokuapp.com/lookup.html.

![](assets/neighborhood-finder-010-o1.gif)

## Example using Guzzle
```php
// Somewhere in Hyde Park
$lat = 42.268489999908255;
$long = -71.10896000012053;

// This service is deployed to Heroku and can be found here:
$url = 'https://boston-neighborhood-finder.herokuapp.com';

$client = new GuzzleHttp\Client;
$request = $client->request('POST', $url, [
    'form_params' => [
        'lat'  => $lat,
        'long' => $long,
    ],
]);

$neighborhood = json_decode($request->getBody());

// $ print_r($neighborhood);
// stdClass Object
// (
//    [neighborhood] => Hyde Park
// )
 
```

## Neighborhood boundaries
This uses the GeoJSON Boston Neighborhood dataset provided by the city here: https://data.boston.gov/dataset/boston-neighborhoods1
Don't debate the neighborhood boundaries with me.

The following neighborhoods are defined:
* Roslindale
* Jamaica Plain
* Mission Hill
* Longwood
* Bay Village
* Leather District
* Chinatown
* North End
* Roxbury
* South End
* Back Bay
* East Boston
* Charlestown
* West End
* Beacon Hill
* Downtown
* Fenway
* Brighton
* West Roxbury
* Hyde Park
* Mattapan
* Dorchester
* South Boston Waterfront
* South Boston
* Allston
* Harbor Islands

The app will return `neighborhood unknown` if it can't find a matching neighborhood.