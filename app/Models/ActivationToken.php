<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivationToken extends Model
{
    use HasFactory;
    protected $table = 'activation_tokens';
    public $timestamps = false;
    protected $fillable=[
        'user_id',
        'token',
        'expires_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
