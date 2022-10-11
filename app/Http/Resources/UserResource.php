<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'user'  => $this['user'],
            'token' => $this['token']
        ];
    }

    public function withResponse($request, $response)
    {
        return $response->setStatusCode($this->resource['status']);
    }
}
