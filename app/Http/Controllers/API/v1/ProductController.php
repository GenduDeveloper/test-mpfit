<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ProductStoreRequest;
use App\Http\Requests\v1\ProductUpdateRequest;
use App\Http\Resources\v1\ProductDetailResource;
use App\Http\Resources\v1\ProductListResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @throws NotFoundHttpException
     */
    public function show(int $productId): ProductDetailResource
    {
        $product = Product::query()->findOrFail($productId);

        return new ProductDetailResource($product);
    }

    public function store(ProductStoreRequest $request, ProductService $productService): JsonResponse
    {
        $productData = $request->getValidatedProductStoreData();

        $newProduct = $productService->createProduct($productData);

        return new JsonResponse([
            'message' => 'Товар успешно создан',
            'data'    => new ProductDetailResource($newProduct)
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function update(ProductUpdateRequest $request, int $productId): JsonResponse
    {
        $product = Product::query()->findOrFail($productId);

        $product->update($request->validated());

        return new JsonResponse([
            'message' => 'Обновлено',
            'data'    => new ProductDetailResource($product)
        ], Response::HTTP_OK);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function destroy(int $productId): JsonResponse
    {
        $product = Product::query()->findOrFail($productId);

        $product->delete();

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
