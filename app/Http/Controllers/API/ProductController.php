<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $service;
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    public function index()
    {
        return response()->json($this->service->getAllProduct());
    }

    public function store(ProductRequest $request)
    {
        return response()->json($this->service->createProduct($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getProductById($id));
    }

    public function update(ProductRequest $request, $id)
    {
        return response()->json($this->service->updateProductById($request->validated(), $id));
    }

    public function destroy($id)
    {
        return response()->json($this->service->deleteProductById($id) ? 'Produk berhasil dihapus' : 'Produk gagal dihapus');
    }
}
