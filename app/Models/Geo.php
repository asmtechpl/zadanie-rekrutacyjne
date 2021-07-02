<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Geo
 * @package App\Models
 */
class Geo extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'addressId');
    }
}
