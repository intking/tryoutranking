<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Score;

class Tryout extends Model
{

  use HasFactory;

  protected $table = 'tryouts';
  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'organizer_name',
    'description',
    'held',
    'due',
    'user_id',
    'cluster_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function registerTryout()
  {
      return $this->hasMany(RegisterTryout::class);
  }

  public function score()
  {
    return $this->hasOne(Score::class);
  }

  public function clusters()
  {
      return $this->belongsTo(Cluster::class, 'cluster_id');
  }

  public function pembahasan()
  {
      return $this->hasOne(Pembahasan::class);
  }
}
