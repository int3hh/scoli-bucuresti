<?php

namespace App\Http\Classes;

use GuzzleHttp\Client;


class MenScraper {
    private $page;
    private $client;
    private $url;
    private $judet;

    public function __construct($judet)
    {
        $this->page = 1;
        $this->judet = $judet;
        switch ($judet) {
            case 'B':
                $this->url = '/carto/app/rest/genericData/find?filters={"SCHOOL_TYPE":"Unitate de invatamant","SCHOOL_TYPE_filter_type":"like","LOCALITY":"Bucuresti","LOCALITY_filter_type":"like"}&page=%d&size=30&sort={"NAME":"asc"}';
                break;
            case 'IF':
                $this->url = '/carto/app/rest/genericData/find?filters={"COUNTY":"ILFOV","COUNTY_filter_type":"like"}&page=%d&size=30&sort={"NAME":"asc"}';
                break;
            default:
                throw new \Exception("Invalid judet");
        }
        $this->client = new Client(['base_uri' => 'https://siiir.edu.ro/', 'headers' => [
            'UserAgent' => 'Mozilla/5.0 (Windows NT 10.0; rv:107.0) Gecko/20100101 Firefox/107.0',
        ]]);
    }

    public function get() {
        $uri = sprintf($this->url, $this->page);
        echo $uri;
        $res = false;
        try {
            $response = $this->client->request('POST', $uri, ['json' => [
                'key' => 'schoolnetwork_grid.key',
                'typeConfiguration' => 'grid',
            ]]);
            $res = json_decode($response->getBody()->getContents())->data->content;
            if (count($res) == 0) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
        $this->page++;
        return $res;
    }
    
}
