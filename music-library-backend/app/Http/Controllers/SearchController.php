<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('term');

        $client = new Client([
            'verify' => false, // Disable SSL verification
        ]);

        $response = $client->request('GET', 'https://itunes.apple.com/search', [
            'query' => [
                'term' => $searchTerm,
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return response()->json([
            'results' => $data['results'],
        ]);
    }
}
