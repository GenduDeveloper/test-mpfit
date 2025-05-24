<?php

declare(strict_types=1);

namespace App\DTO;

readonly class ProductStoreData
{
    public function __construct(
        public string  $name,
        public int     $categoryId,
        public ?string $description,
        public string  $price
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['category_id'],
            $data['description'],
            $data['price']
        );
    }
}
