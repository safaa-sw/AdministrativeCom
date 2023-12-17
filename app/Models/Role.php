<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
    ];

    public function operations()
    {
        return $this->belongsToMany(Operation::class, 'privileges')->withPivot('accept');
    }

   
    public function users()
    {
        return $this->hasMany(User::class);
    }
    

}
