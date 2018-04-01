<?php

namespace Modules\Products\Entities;

class ProductBuilder
{
    public function build($loggedUserId, $request)
    {
        $product = new Products();
        $product->user_id = $loggedUserId;
        $product->fill($request->all());
       
        return $product;       
    }
}
