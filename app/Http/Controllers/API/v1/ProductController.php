<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductDetailResource;
use App\Http\Resources\v1\ProductListResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(ProductService $productService): JsonResponse
    {
        $products = $productService->getPaginatedProducts();

        return ProductListResource::collection($products)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function show(int $productId): ProductDetailResource
    {
        $product = Product::query()->findOrFail($productId);

        return new ProductDetailResource($product);
    }

    public function store()
    {

    }
}
