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

    public function index(Request $request, $characterId = null)
    {
        try {
            $data = $this->service->characters($characterId, $request->all());
            return response()->json($data, 200);
        } catch (\Exception $exception) {
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
            return response()->json($data, $exception->getCode());
        }

    }

    public function comics($characterId, Request $request)
    {
        try {
            $data = $this->service->comics($characterId, $request->all());
            return response()->json($data, 200);
        }catch (\Exception $exception){
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
            return response()->json($data, $exception->getCode());
        }
    }

    public function events($characterId, Request $request)
    {
        try {
            $data = $this->service->events($characterId, $request->all());
            return response()->json($data, 200);
        }catch (\Exception $exception){
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
            return response()->json($data, $exception->getCode());
        }
    }

    public function series($characterId, Request $request)
    {
        try {
            $data = $this->service->series($characterId, $request->all());
            return response()->json($data, 200);
        }catch (\Exception $exception){
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
            return response()->json($data, $exception->getCode());
        }
    }

    public function stories($characterId, Request $request)
    {
        try {
            $data = $this->service->stories($characterId, $request->all());
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
