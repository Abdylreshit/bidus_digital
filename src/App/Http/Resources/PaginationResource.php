<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as BaseResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
class PaginationResource extends BaseResourceCollection
{
    private JsonResource $jsonResource;
    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, JsonResource $jsonResource)
    {
        parent::__construct($resource);

        $this->resource = $this->collectResource($resource);

        $this->jsonResource = $jsonResource;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->jsonResource,
            'pagination' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'prev_page_url' => $this->previousPageUrl(),
                'next_page_url' => $this->nextPageUrl(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'count' => $this->count()
            ]
        ];
    }
}

