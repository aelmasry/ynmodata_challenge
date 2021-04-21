<?php

use Nahid\JsonQ\Jsonq;
use GuzzleHttp\Client;

class DataManager
{

    public function search($data,string $searchKey)
    {
        $jsonq = new Jsonq($data);
        $result = $jsonq->from('data')
            ->where('name', '=', $searchKey)
            ->orWhere('city', '=', $searchKey)
            ->orWhere('price', '=', $searchKey)
            ->get()->toArray();

        return $result;
    }

    public function fetch()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://run.mocky.io',
        ]);
        // fetch data
        $response = $client->request('GET', '/v3/0d6aab31-bb68-4d89-acc5-bc4148a3cff3');

        if (200 != $response->getStatusCode()) {
            //abort(400, "something wont wrong");
        }

        return $response->getBody();

    }
}
