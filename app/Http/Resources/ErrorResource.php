<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'message' => $this->resource['message'],
        ];
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
