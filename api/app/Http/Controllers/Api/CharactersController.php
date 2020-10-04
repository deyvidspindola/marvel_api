<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CharactersService;
use Illuminate\Http\Request;

class CharactersController extends Controller
{

    /**
     * @var CharactersService
     */
    private $service;

    public function __construct(CharactersService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($characterId=null)
    {
        $data = [
            'data' => [
                'offset' => 0,
                'limit' => 20,
                'total' => 1493,
                'count' => 20,
            ],
            'results' => [
                'id' => 123,
                'name' => 'HULK',
                'description' => 'Mais forte que o Thanos',
                'modified' => 'N/A',
                'thumbnail' => [
                    "path" => "http://i.annihil.us/u/prod/marvel/i/mg/c/e0/535fecbbb9784",
                    "extension" => "jpg"
                ],
                'resourceURI' => "http://gateway.marvel.com/v1/public/characters/1011334",
                'comics' => [
                    "available" => 12,
                    "collectionURI" => "http://gateway.marvel.com/v1/public/characters/1011334/comics",
                    'items' => [
                        "resourceURI" => "http://gateway.marvel.com/v1/public/comics/21366",
                        "name" => "Avengers: The Initiative (2007) #14"
                    ],
                    'returned' => 12
                ],
                'series' => [
                    "available" => 12,
                    "collectionURI" => "http://gateway.marvel.com/v1/public/characters/1011334/comics",
                    'items' => [
                        "resourceURI" => "http://gateway.marvel.com/v1/public/comics/21366",
                        "name" => "Avengers: The Initiative (2007) #14"
                    ],
                    'returned' => 12
                ],
                'stories' => [
                    "available" => 12,
                    "collectionURI" => "http://gateway.marvel.com/v1/public/characters/1011334/comics",
                    'items' => [
                        "resourceURI" => "http://gateway.marvel.com/v1/public/comics/21366",
                        "name" => "Avengers: The Initiative (2007) #14",
                        'type' => 'dfsdf'
                    ],
                    'returned' => 12
                ],
                'events' => [
                    "available" => 12,
                    "collectionURI" => "http://gateway.marvel.com/v1/public/characters/1011334/comics",
                    'items' => [
                        "resourceURI" => "http://gateway.marvel.com/v1/public/comics/21366",
                        "name" => "Avengers: The Initiative (2007) #14"
                    ],
                    'returned' => 12
                ],
                'urls' => [
                    [
                        "type" => "detail",
                        "url" => "http://gateway.marvel.com/v1/public/characters/1011334/comics",
                    ],
                    [
                        "type" => "detail",
                        "url" => "http://gateway.marvel.com/v1/public/characters/1011334/comics",
                    ]
                ],
            ],
        ];

        return response()->json($data, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comics($characterId)
    {
        return 'comics'.$characterId;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events($characterId)
    {
        return 'events'.$characterId;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function series($characterId)
    {
        return 'series'.$characterId;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stories($characterId)
    {
        return 'stories'.$characterId;
    }


}
