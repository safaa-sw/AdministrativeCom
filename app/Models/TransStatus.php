<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}
