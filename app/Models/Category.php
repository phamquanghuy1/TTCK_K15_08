<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Quan hệ với Project thông qua bảng project_category
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_category');
    }
}
