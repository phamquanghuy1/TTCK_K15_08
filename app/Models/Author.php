<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'affiliation',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_author');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }
}
