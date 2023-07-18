<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Http\Controllers\Scrapping;

class ProductsController extends Controller
{
   

    public function dbregister()
    {
        $scrap = new Scrapping();
       
        $arrayProd = $scrap->scrapproducts();

         foreach ( $arrayProd as $item) {
            
            $product = new Product;            
            $product->barcode = $item['barcode'];
            $product->status = 'imported';
            $product->imported_t = now();
            $product->url = $item['url'];
            $product->product_name = $item['product_name'];
            $product->quantity = $item['quantity'];
            $product->categories = $item['categories'];
            $product->packaging = $item['packaging'];
            $product->brands = $item['brands'];
            $product->image_url = $item['image_url'];
            $product->code = $item['code'];
            $valida = $product->save();             
        } 
        
       
    }

    public function show($id)
    {
         $product = Product::whereIn('id', [$id])->get();;

        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Produto não encontrado',
            ]);
        } 
    }

    public function showAll()
    {
        $perPage = 20;

        $products = Product::paginate($perPage);

        return $products;
    }
}
