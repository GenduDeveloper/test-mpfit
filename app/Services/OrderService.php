<?php

declare(strict_types=1);

namespace App\Services;

use App\BuissnesExceptions\OrderException;
use App\DTO\OrderStoreData;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderService
{
    /**
     * @throws OrderException
     */
    public function createOrder(OrderStoreData $data): Order
    {
        $product = Product::query()->find($data->productId);

        if ($product === null) {
            throw new NotFoundHttpException('Выбранного товара не существует');
        }

        if ($data->productQuantity <= 0) {
            throw new OrderException('Кол-во товара для заказа не может быть меньше единицы');
        }

        $newOrder                      = new Order();
        $newOrder->customer_name       = $data->customerName;
        $newOrder->customer_surname    = $data->customerSurname;
        $newOrder->customer_patronymic = $data->customerPatronymic;
        $newOrder->created_at          = Carbon::now();
        $newOrder->status              = OrderStatusEnum::NEW;
        $newOrder->comment             = $data->comment;
        $newOrder->product_id          = $product->id;
        $newOrder->product_quantity    = $data->productQuantity;
        $newOrder->total_price         = $this->calculateTotalPrice($product, $data->productQuantity);
        $newOrder->save();

        return $newOrder;
    }

    private function calculateTotalPrice(Product $product, int $quantity): float
    {
        return round($product->price * $quantity, 2);
    }
}
