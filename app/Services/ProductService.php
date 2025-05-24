<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\ProductStoreData;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Возвращает список товаров с их категорией
     *
     * @return LengthAwarePaginator
     *
     */
    public function getPaginatedProducts(): LengthAwarePaginator
    {
        return DB::table('products AS p')
            ->select(['p.id', 'p.name', 'p.price', 'c.name AS category_name'])
            ->join('categories AS c', 'c.id', '=', 'p.category_id')
            ->orderBy('p.name')
            ->paginate(Product::PER_PAGE);
    }

    public function createProduct(ProductStoreData $productData): Product
    {
        $newProduct              = new Product();
        $newProduct->name        = $productData->name;
        $newProduct->category_id = $productData->categoryId;
        $newProduct->description = $productData->description ?? null;
        $newProduct->price       = $productData->price;
        $newProduct->save();

        return $newProduct;
    }
}
