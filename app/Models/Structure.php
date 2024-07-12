<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Structure extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'mail',
        'phone',
        'typeStructure'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

//    public function products()
//    {
//        return $this->hasMany(Product::class, "provider_id", "id");
//    }
//
//    public function product()
//    {
//        return $this->hasMany(Product::class, "company_id", "id");
//
//    }

}
