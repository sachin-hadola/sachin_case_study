<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [

        'name', 'category_id','price', 'description', 'avatar'

    ];

    public function cart() {
        return $this->hasMany('App\Models\Cart');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
