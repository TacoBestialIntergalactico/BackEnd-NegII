<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shopping extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['Quantity', 'IdUserFk', 'IdProductFk'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'IdUserFk');
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Products::class, 'IdProductFk');
    }
}
