<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UnAuthenticatedException extends ApplicationException
{
    public function __construct()
    {
        $this->error = 'UNAUTHENTICATED';
        $this->message = __('errors.unauthenticated');
        $this->code = Response::HTTP_UNAUTHORIZED;
        $this->data = [];

        parent::__construct();
    }
}
