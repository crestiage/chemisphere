<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = "product_brand";
    protected $fillable = ['code','name','description','sort_order'] ;
}
