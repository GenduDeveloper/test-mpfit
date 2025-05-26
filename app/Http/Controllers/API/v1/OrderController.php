<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\BuissnesExceptions\OrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\OrderStoreRequest;
use App\Http\Resources\v1\OrderDetailResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::query()->paginate(Order::PER_PAGE);

        return OrderDetailResource::collection($orders)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(OrderStoreRequest $request, OrderService $orderService): JsonResponse
    {
        $orderData = $request->getValidatedOrderStoreData();

        try {
            $newOrder = $orderService->createOrder($orderData);
        } catch (OrderException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'data' => new OrderDetailResource($newOrder)
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function show(int $orderId): OrderDetailResource
    {
        $order = Order::query()->findOrFail($orderId);

        return new OrderDetailResource($order);
    }
}
