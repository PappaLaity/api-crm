<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Stock extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $fillable = [
        'quantity',
        'product_company_id',
    ];

    public function products()
    {
        return $this->hasOne(Product::class, "company_id", "product_company_id");
    }
}
