<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserType;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'gender',
        'avatar',
        'status',
    ];


    const STATUS_ACTIVE = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_CANCEL = -1;

    protected $setStatus = [
        self::STATUS_ACTIVE => [
            'name' => 'Hoạt động',
            'class' => 'badge text-bg-primary',
        ],
        self::STATUS_DEFAULT => [
            'name' => 'Chưa kích hoạt',
            'class' => 'badge text-bg-secondary',
        ],
        self::STATUS_CANCEL => [
            'name' => 'Tạm khóa',
            'class' => 'badge text-bg-danger',
        ]
    ];

    public function getStatus(){
        return Arr::get($this->setStatus,$this->status, []);
    }

    public function userType(){
        return $this->belongsToMany(UserType::class, 'user_has_type', 'user_id', '');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
