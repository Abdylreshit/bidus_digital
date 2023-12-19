<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends ApplicationException
{
    public function __construct()
    {
        $this->error = 'FORBIDDEN_EXCEPTION';
        $this->message = __('errors.forbidden');
        $this->code = Response::HTTP_FORBIDDEN;
        $this->data = [];

        parent::__construct();
    }
}
