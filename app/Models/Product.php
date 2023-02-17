<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'color_id',
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
