<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
