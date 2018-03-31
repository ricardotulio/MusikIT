<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Categories\Entities\Category;

class Products extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
