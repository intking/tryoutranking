<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Tryout;
use App\Models\Score;
use App\Models\Role;

class User extends Authenticatable
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;

  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'email',
    'password',
    'role_id'
  ];

  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  protected $appends = [
    'profile_photo_url',
  ];

//   public function __construct(array $attributes = [])
//   {
//     parent::__construct($attributes);
//     self::created(function(User $user) {
//       if (!$user->roles()->get()->contains(3)) {
//         $user->roles()->attach(3);
//       }
//     });
//   }

  public function roles()
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public function tryout()
  {
    return $this->hasMany(Tryout::class);
  }

  public function registerTryout()
  {
      return $this->hasMany(RegisterTryout::class);
  }

  public function score()
  {
    return $this->hasMany(Score::class);
  }
}
