<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Quantity', 'IdUserFk', 'IdProductFk'];

    /**
     * Get the user that owns the shopping cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'IdUserFk');
    }

    /**
     * Get the product associated with the shopping cart.
     */
    public function product()
    {
        return $this->belongsTo(Products::class, 'IdProductFk');
    }

}
