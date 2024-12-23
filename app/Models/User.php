<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];
    public function projects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'created_by');
    }
}
