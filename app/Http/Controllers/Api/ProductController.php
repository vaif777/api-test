<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Http\Resources\ProductResources;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResources::collection(Product::with('images')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $res = [];

        foreach ($data['products'] as $product) {
            
            $images = $product['images'];
            unset($product['images'], $product['id']);
          
            if (strpos($product['title'], 'iPhone') !== false) {
                 
                $productCreated = Product::create($product);
                $imagesCreate = [];

                foreach ($images as $image) {

                    $imagesCreate[] = new Image(['link_image' => $image]);
                }

                $productCreated->images()->saveMany($imagesCreate);
                $res[] = $productCreated;
                
            }
        }

        return ProductResources::collection($res);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ProductResources(Product::with('images')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return  new ProductResources($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
