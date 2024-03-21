<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    use HasFactory;


    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'Image',
        'IdcategoriesFK'
    ];

    public $timestamps= false;

    public function Products(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'IdcategoriesFK','id');
    }

    public function shopping(): HasMany{
        return $this->hasMany(shopping::class, 'IdProductFk');
    }
}
