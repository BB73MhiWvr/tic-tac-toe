<?php
declare(strict_types=1);

namespace Api\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ControllerTrait
{
    private function sendResponse(array $data): void
    {
        echo new JsonResponse($data);
    }

    private function sendNotFoundErrorResponse(): void
    {
        echo new JsonResponse(status: 404);
    }

    private function sendNotAcceptableRequestErrorResponse(): void
    {
        echo new JsonResponse(status: 406);
    }

    private function sendConflictErrorResponse(): void
    {
        echo new JsonResponse(status: 409);
    }

    private function sendServerErrorResponse(): void
    {
        echo new JsonResponse(status: 500);
    }
}
