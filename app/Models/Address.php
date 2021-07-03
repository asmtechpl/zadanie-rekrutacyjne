<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Address
 * @package App\Models
 */
class Address extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'street',
        'suite',
        'city',
        'zipcode',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class,'userId');
    }

    /**
     * @return HasOne
     */
    public function geo(): HasOne
    {
        return $this->hasOne(Geo::class,'addressId');
    }
}
