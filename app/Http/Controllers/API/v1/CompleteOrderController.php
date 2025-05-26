<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompleteOrderController extends Controller
{
    /**
     * @throws NotFoundHttpException
     */
    public function __invoke(int $orderId, OrderService $orderService): JsonResponse
    {
        $orderService->changeStatusToCompleted($orderId);

        return new JsonResponse(['message' => 'Успешно'], Response::HTTP_OK);
    }
}
