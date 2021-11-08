<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class GuzzleService
{
    const GOOGLE_API_URL = "https://www.googleapis.com/youtube/v3/search";

    public function searchYouTube(String $search_term, String $page_token = null): ?Object
    {
        $api_key = config('google.api_key');

        $client = new Client();
        try
        {
            return $client->request('GET', self::GOOGLE_API_URL, [
                'query' => [
                    'part' => 'snippet',
                    "maxResults" => 20,
                    'type' => 'video',
                    'pageToken' => $page_token,
                    'q' => $search_term,
                    'key' => $api_key
                ]
            ]);
        }
        catch (Exception $e) {
            return null;
        }

    }


}
