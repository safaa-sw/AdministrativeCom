<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransHistory extends Model
{
    use HasFactory;

    protected $fillable=[
        'description','date','transaction_id', 'action_id', 'user_id',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
