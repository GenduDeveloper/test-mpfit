<?php

declare(strict_types=1);

namespace App\DTO;

readonly class OrderStoreData
{
    public function __construct(
        public string  $customerName,
        public string  $customerSurname,
        public string  $customerPatronymic,
        public ?string $comment,
        public int     $productId,
        public int     $productQuantity
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer_name'],
            $data['customer_surname'],
            $data['customer_patronymic'],
            $data['comment'],
            $data['product_id'],
            $data['product_quantity']
        );
    }
}
