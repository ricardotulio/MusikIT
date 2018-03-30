<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
}
