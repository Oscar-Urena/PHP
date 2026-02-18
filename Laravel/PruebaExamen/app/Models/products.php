<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;

    protected $fillable = ['code', 'name', 'quantity', 'price', 'description', 'category_id'];

    public function category(){
        return $this->belongsTo(categories::class, 'category_id');
    }
}
