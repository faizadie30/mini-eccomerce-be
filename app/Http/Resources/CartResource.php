<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }

    public function toArray($request)
    {
        $response =  [
            'status'   => $this->status,
            'message'   => $this->message,
            'data' => empty($this->resource) ? [] : $this->resource
        ];

        return $response;
    }
}
