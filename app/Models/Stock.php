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
        'price',
        'ref_company',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, "ref_company", "ref_company");
    }

    public function incStock($qte)
    {
        $this->quantity += $qte;
    }

    public function decStock($qte)
    {
        if ($this->quantity >= $qte) {
            $this->quantity -= $qte;
        }

    }
}
