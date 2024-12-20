<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'abstract',
        'publication_date',
        'project_id',
        'created_by',
    ];

    // Quan hệ với Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Quan hệ với User (người tạo bài viết)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Quan hệ với Author thông qua bảng article_author
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'article_author');
    }
}
