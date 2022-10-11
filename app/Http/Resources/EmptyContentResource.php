<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmptyContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return ['success' => 'true'];
    }

    /**
     * @param $request
     * @param $response
     */
    public function withResponse($request, $response)
    {
        return $response->setStatusCode($this->resource['status']);
    }
}
