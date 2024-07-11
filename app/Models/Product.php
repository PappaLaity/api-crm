<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barcode',
        'designation',
        'price',
        'ref_provider',
        'ref_company',
        'provider_id',
        'company_id',
    ];

    public function provider()
    {
        return $this->belongsTo(Structure::class, "provider_id");
    }

    public function company()
    {
        return $this->belongsTo(Structure::class, "company_id");
    }
}
