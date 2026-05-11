<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Foods extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'category_id',
        'hotel_id',
        'name',
        'price',
        'description',
        'discount',
        'status',
        'profile_photo'
    ];

    public function foodCategory(){
        return $this->belongsTo(FoodCategory::class, 'category_id');
    }

    public function hotel(){
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }
}
