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

    public function index($characterId = null, $endpoint = null, Request $request)
    {
        try {
            $data = $this->service->methods($characterId, $endpoint, $request->all());
            return response()->json($data, 200);
        }catch (\Exception $exception){
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
            return response()->json($data, $exception->getCode());
        }
    }
}
