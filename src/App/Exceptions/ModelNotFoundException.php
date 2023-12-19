<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ModelNotFoundException extends ApplicationException
{
    public function __construct()
    {
        $this->error = 'NOT_FOUND_EXCEPTION';
        $this->message = __('errors.not_found');
        $this->code = Response::HTTP_NOT_FOUND;
        $this->data = [];

        parent::__construct();
    }
}
