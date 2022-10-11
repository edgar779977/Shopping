<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'product'=>$this->resource['product']
        ];
    }

    /**
     * @param $request
     * @param $response
     * @return JsonResponse
     */
    public function withResponse($request, $response): JsonResponse
    {
        return $response->setStatusCode($this->resource['status']);
    }
}
