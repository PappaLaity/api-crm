<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OrderLine extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function product()
    {
        return $this->hasOne(Product::class, "id", "product_id");
    }
}
