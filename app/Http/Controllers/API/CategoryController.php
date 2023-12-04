<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAllCategory());
    }

    public function store(CategoryRequest $request)
    {
        return response()->json($this->service->createCategory($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getCategoryById($id));
    }

    public function update(CategoryRequest $request, $id)
    {
        return response()->json($this->service->updateCategoryById($request->validated(), $id));
    }

    public function destroy($id)
    {
        return response()->json($this->service->deleteCategoryById($id) ? 'Kategori Produk berhasil dihapus' : 'Kategori Produk gagal dihapus');
    }
}
