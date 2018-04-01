<?php

namespace Modules\Products\Http\Controller\Product;

use Illuminate\Http\Response;
use Modules\Products\Http\Requests\ProductsRequest;
use Modules\Products\Entities\ProductBuilder;

class StoreProductHandler
{
    private $builder;

    public function __construct(ProductBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function __invoke(
        ProductsRequest $request,
        Respose $respose
    ) {
        $product = $this->builder->build(Auth::id(), $request);
        $product->save();

        $message = 'Product created successfully';

        return redirect('products')->with('message', $message);
    }
}
