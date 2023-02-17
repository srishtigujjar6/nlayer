<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'color'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    public function products(){
        return $this->hasMany(Product::class);
    }
        
}
