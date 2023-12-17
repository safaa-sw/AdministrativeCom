<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectedTrans extends Model
{
    use HasFactory;

    protected $fillable=[
        'transaction1_id','transaction2_id','connect_type',
    ];

   
    public function transaction1()
    {
        return $this->belongsTo(Transaction::class, 'transaction1_id');
    }

    public function transaction2()
    {
        return $this->belongsTo(Transaction::class, 'transaction2_id');
    }
}
