<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','details'
    ];

    public function transHistory()
    {
        return $this->hasMany(TransHistory::class);
    }
}
