<?php

namespace App\Http\Controllers;

use App\Managers\CommonManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $payload
     * @return JsonResponse
     */
    public function responseSuccess($payload) :JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'payload' => $payload
        ], 200);
    }

    /**
     * @return JsonResponse
     */
    public function responseError() :JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'payload' => []
        ], 500);
    }


    /**
     * @return JsonResponse
     */
    public function responseEmpty() :JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'payload' => []
        ], 200);
    }
}
