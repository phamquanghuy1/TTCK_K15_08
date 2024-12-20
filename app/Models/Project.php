<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'created_by',
    ];

    // Quan hệ với User (người tạo dự án)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Quan hệ với Article
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Quan hệ với Category thông qua bảng project_category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'project_category');
    }
}
