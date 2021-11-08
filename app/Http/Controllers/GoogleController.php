<?php

namespace App\Http\Controllers;

use App\Services\GuzzleService;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function search(Request $request, GuzzleService $gs)
    {
        $search_term  = !empty($request->searchterm) ? $request->searchterm : null;
        $page_token  = !empty($request->pagetoken) ? $request->pagetoken : null;
        $api_response = $gs->searchYouTube($search_term, $page_token);

        if (!empty($api_response) && $api_response->getStatusCode() == 200)
        {
            $yt_response = json_decode($api_response->getBody());

            $data = array();
            $data['prevPageToken'] = !empty($yt_response->prevPageToken) ? $yt_response->prevPageToken : null;
            $data['nextPageToken'] = !empty($yt_response->nextPageToken) ? $yt_response->nextPageToken : null;
            $data['videos'] = array();
            foreach ($yt_response->items as $video)
            {
                $data['videos'][] = array('id' => $video->id->videoId,
                                        'url' => 'https://www.youtube.com/watch?v=' . $video->id->videoId,
                                        'title' => $video->snippet->title,
                                        'description' => $video->snippet->description,
                                        'thumbnail' => $video->snippet->thumbnails->medium->url
                );
            }
            return view('search_results', ['data' => $data]);
        }
        else
        {
            return response('Error occurred when querying Google API.', 503);
        }

    }
}
