<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function getAllProduct(): Collection
    {
        return Product::all();
    }

    public function getProductById(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function updateProductById(array $data, int $id): Product
    {
        $product = $this->getProductById($id);
        $product->update($data);
        return $product;
    }

    public function deleteProductById(int $id): bool
    {
        return Product::destroy($id) == 1;
    }
}
