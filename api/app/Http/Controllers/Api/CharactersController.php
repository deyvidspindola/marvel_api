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
          'name' => ''
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
