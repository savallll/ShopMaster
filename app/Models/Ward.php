<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'wards';
    protected $fillable=[
        'province_id',
        'wards_id',
        'name',
    ];
}
