<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * GetStoreResponse
     *
     * @param JsonResource $object ""
     *
     * @return JsonResponse
     */
    public function getStoreResponse(JsonResource $object) : JsonResponse
    {
        return $object->response()->setStatusCode(201);
    }


    /**
     * @return Response
     */
    public function getNoContentResponse(): Response
    {
        return response(null, 204);
    }

    /**
     * GetSuccessResponse
     *
     * @param JsonResource $object ""
     *
     * @return JsonResponse
     */
    public function getSuccessResponse(JsonResource $object) : JsonResponse
    {
        return $object->response()->setStatusCode(200);
    }


    /**
     * GetBadResponse
     *
     * @param JsonResource $object ""
     *
     * @return JsonResponse
     */
    public function getBadResponse(JsonResource $object) : JsonResponse
    {
        return $object->response()->setStatusCode(400);
    }


    /**
     * GetErrorResponse
     *
     * @param JsonResource $object ""
     *
     * @return JsonResponse
     */
    public function getErrorResponse(JsonResource $object) : JsonResponse
    {
        return $object->response()->setStatusCode(422);
    }


    /**
     * GetForbiddenResponse
     *
     * @param JsonResource $object ""
     *
     * @return JsonResponse
     */
    public function getForbiddenResponse(JsonResource $object) : JsonResponse
    {
        return $object->response()->setStatusCode(403);
    }
}
