<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Incoming extends Model
{
    use HasFactory;

    protected $fillable=[
        'from_org',
    ];

    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'type');
    }
}
