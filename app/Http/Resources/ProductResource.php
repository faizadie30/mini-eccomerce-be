<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }

    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function toArray($request)
    {
        $response =  [
            'status'   => $this->status,
            'message'   => $this->message,
        ];

        if (!empty($this->resource)) {
            $response['data'] = $this->resource;
            // array_push($response, ['data' => $this->resource]);
        }

        return $response;
    }
}
