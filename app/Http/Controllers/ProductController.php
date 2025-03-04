<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Product API",
 *      version="1.0.0",
 *      description="This is a sample API documentation for managing products"
 * )
 *
 * @OA\Server(
 *      url="http://127.0.0.1:8000/api",
 *      description="Local Development Server"
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     * )
     */
    public function index() {
        $products = Cache::remember('products', 3600, function () {
            return Product::all();
        });
        return response()->json($products, 200);
    }

    public function store(Request $request) {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    public function show($id) {
        return response()->json(Product::findOrFail($id), 200);
    }
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }
    public function destroy($id) {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted'], 200);
    }
}
