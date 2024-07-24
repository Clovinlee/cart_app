<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\v1\ProductResource;
use App\Http\Resources\v1\ProductCollection;
use App\Models\Product;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    private $elastic_client;

    public function __construct(Client $elastic_client)
    {
        $this->elastic_client = $elastic_client;
    }

    /**
     * Search for a product
     * (ELASTICSEARCH & REDIS CACHE)
     * elasticsearch:9200
     */
    public function search(Request $request)
    {
        $response = $this->elastic_client->search([
            'index' => 'products',
            'body' => [
                'size' => 100,
                'query' => [
                    'wildcard' => [
                        'name' => "*" . ($request->input("name") ?? "") . "*"
                    ]
                ]
            ]
        ]);
        // Need to parse as Array (or for debugging)
        // $responseArray = $response->asArray();

        $productIds = array_column($response["hits"]["hits"], "_id");
        $products = [];
        try {
            $cacheKey = 'products_' . implode('_', $productIds);

            // 60 second
            $products = Cache::remember($cacheKey, 60, function () use ($productIds) {
                return Product::query()->findMany($productIds);
            });
        } catch (\Throwable $th) {
            //throw $th;
            throw new HttpResponseException(makeJson(404, 'Error retrieving products' . $th->getMessage()));
        }

        // Cache::set("products", "Hey");
        return response()->json($products);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductIndexRequest $request)
    {
        //
        // $products = Product::all();

        $cacheKey = 'products_' . md5(json_encode($request->validated()));

        $products = Cache::remember($cacheKey, 300, function () use ($request) {
            $query = Product::query();

            // Apply name filter if provided
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            // Apply min_price filter if provided
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }

            // Apply max_price filter if provided
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Conditionally eager load categories if requested
            if ($request->boolean('withCategory')) {
                $query->with('category'); // Note: Use 'category' if the relationship is singular
            }

            return $query->paginate(15);
        });



        return new ProductCollection($products->appends($request->query()));
        // return ProductResource::collection($products->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());
        return makeJson(201, 'Product created successfully', new ProductResource($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $query = Product::query();

            if ($request->boolean("withCategory") == true) {
                $query->with("category");
            }

            $product = $query->findOrFail($id);
            return makeJson(200, 'Product retrieved successfully', new ProductResource($product));
        } catch (\Throwable $th) {
            //throw $th;
            throw new HttpResponseException(makeJson(404, 'Product not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = null;

        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json(["message" => "Product not found"], 404));
        }

        if (strtoupper($request->method()) == "PATCH") {
            $product->update($request->validated());
            return makeJson(200, 'Product patched successfully', new ProductResource($product));
        } else {
            $product->update($request->validated());
            return makeJson(200, 'Product updated successfully', new ProductResource($product));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $r = Product::destroy($id);
        if ($r == 0) {
            throw new HttpResponseException(response()->json(["message" => "Product not found"], 404));
        }
        return makeJson(200, 'Product deleted successfully');
    }
}
