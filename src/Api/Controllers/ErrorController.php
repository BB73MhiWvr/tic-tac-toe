<?php
declare(strict_types=1);

namespace Api\Controllers;

class ErrorController
{
    use ControllerTrait;

    public function show(): void
    {
        $this->sendNotFoundErrorResponse();
    }
}
