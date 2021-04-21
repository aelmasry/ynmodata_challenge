<?php

require 'vendor/autoload.php';

$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://run.mocky.io',
]);

// fetch data
$response = $client->request('GET', '/v3/0d6aab31-bb68-4d89-acc5-bc4148a3cff3');

if (200 == $response->getStatusCode()) {
    $result =  $response->getBody();
    $result = json_decode($result, true);
    $data = $result['data'];
} else {
    return 'No response from endpoint';
}

$output = '';

if (isset($_REQUEST["query"]))
{
    $jsonq = new Nahid\JsonQ\Jsonq($response->getBody());

    $search = $_REQUEST["query"];
    $result = $jsonq->from('data')
        ->where('name', '=', $search)
        ->orWhere('city', '=', $search)
        ->orWhere('price', '=', $search)
        ->get();

    $data = json_decode($result, true);
}

$output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>ID</th>
     <th>Name</th>
     <th>City</th>
     <th>Price</th>
    </tr>
 ';

 foreach($data as $hotel)
 {
    $output .= '
    <tr>
        <td>' . $hotel["id"] . '</td>
        <td>' . $hotel["name"] . '</td>
        <td>' . $hotel["city"] . '</td>
        <td>' . $hotel["price"] . '</td>
    </tr>
    ';
 }

echo $output;
