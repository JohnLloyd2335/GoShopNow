<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price', 'brand_id', 'category_id', 'description' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }   

    public function stock() : HasMany
    {
        return $this->hasMany(ProductStock::class);
    }


    
}
