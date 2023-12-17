<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransType extends Model
{
    use HasFactory;

    protected $fillable=[
        'type','name',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
