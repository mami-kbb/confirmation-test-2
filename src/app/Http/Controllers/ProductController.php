<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        $message = "商品一覧";
        $keyword = null;
        $priceOrder = null;
        return view('index', compact('products', 'message', 'keyword', 'priceOrder'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $priceOrder = $request->input('price');

        $query = Product::query();$query->keywordSearch($keyword);
        $query->priceOrder($priceOrder);
        $products = $query->paginate(6);

        if($keyword) {
            $message = "\"{$keyword}\"の商品一覧";
        } else {
            $message = "商品一覧";
        }

        return view('index', compact('products', 'message', 'keyword', 'priceOrder'));
    }

    public function show($productId)
    {
        session()->forget('errors');

        $product = Product::findOrFail($productId);
        $selectedSeasons = $product->seasons->pluck('id')->toArray();

        return view('show', compact('product', 'selectedSeasons'));
    }

    public function update(ProductRequest $request,$productId)
    {
        $product = Product::findOrFail($productId);

        if ($request->hasFile('image')){
            if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        $product->seasons()->sync($request->season);

        return redirect('/products');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect('/products');
    }

    public function register()
    {
        session()->forget('errors');
        
        return view('create');
    }

    public function store(ProductRequest $request)
    {
        $path = $request->file('image')->store('images', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        $product->seasons()->attach($request->season);

        return redirect('/products');
    }
}
