<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = ['name','description','sort_order','product_brand_code', 'display_image_filepath'] ;
}
