<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'classification',
        'project_id',
        'created_by',
        'category_id',
        'noi_dung',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(Author::class, 'created_by');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'article_author');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
