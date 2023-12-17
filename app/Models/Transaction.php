<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'subject', 'trans_type_id', 'secret_id', 'importance_id', 'trans_status_id', 'user_id',
    ];


    public function type(): MorphTo
    {
        return $this->morphTo();
    }

    public function transType()
    {
        return $this->belongsTo(TransType::class);
    }

    public function secret()
    {
        return $this->belongsTo(Secret::class);
    }

    public function importance()
    {
        return $this->belongsTo(Importance::class);
    }

    public function transStatus()
    {
        return $this->belongsTo(TransStatus::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function transHistory()
    {
        return $this->hasMany(TransHistory::class);
    }

}
