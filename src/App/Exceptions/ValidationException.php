<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ValidationException extends ApplicationException
{
    public function __construct(array $data)
    {
        $this->error = 'INVALID_DATA_EXCEPTION';
        $this->message = __('errors.invalid_data');
        $this->code = Response::HTTP_UNPROCESSABLE_ENTITY;
        $this->data = $data;

        parent::__construct();
    }
}
