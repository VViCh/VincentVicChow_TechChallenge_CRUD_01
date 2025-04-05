<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function createProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive,discontinued',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'category' => 'sometimes|required|string|max:255',
            'sku' => 'sometimes|required|string|max:255|unique:products,sku,' . $product->id,
            'image_url' => 'sometimes|nullable|url',
            'status' => 'sometimes|required|in:active,inactive,discontinued',
        ]);

        $product->update($validatedData);
        return response()->json($product);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}
