<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Categories\Entities\Category;
use Modules\Products\Entities\Products;
use Modules\Products\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Products::where('user_id', $user->id)->get();

        return view('products::index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('products::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ProductsRequest $request)
    {
        try {
            $product = new Products();
            $product->user_id = Auth::id();
            $product->fill($request->all());
            $product->save();

            $message = 'Product created successfully';

            return redirect('products')->with('message', $message);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $product = Products::find($id);

        if (Auth::id() !== $product->user_id)
            return redirect('products')->with('error', 'You don\'t have permition to edit this product! Get the hell out!');

        $categories = Category::all();

        return view('products::edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ProductsRequest $request)
    {
        try {
            $product = Products::find($request->product_id);
            $product->fill($request->all());
            $product->save();

            $message = 'Product successfully edited';

            return redirect('products')->with('message', $message);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $prodcut = Products::find($id);
            $prodcut->delete();

            return back()->with('message', 'The products was successfully deleted');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
