<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CharactersService;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

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

    public function index($characterId = null)
    {
        try {
            $data = $this->service->characters($characterId);
            return response()->json($data, 200);
        } catch (Exception $exception) {
            dd($exception);
        }

    }

    public function comics($characterId)
    {
        $data = $this->service->comics($characterId);
        return response()->json($data, 200);
    }

    public function events($characterId)
    {
        $data = $this->service->events($characterId);
        return response()->json($data, 200);
    }

    public function series($characterId)
    {
        $data = $this->service->series($characterId);
        return response()->json($data, 200);
    }

    public function stories($characterId)
    {
        $data = $this->service->stories($characterId);
        return response()->json($data, 200);
    }


}
