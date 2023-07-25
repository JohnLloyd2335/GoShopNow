<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_line_1',
        'address_line_2',
        'region',
        'province',
        'city_municipality',
        'postal_code'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
