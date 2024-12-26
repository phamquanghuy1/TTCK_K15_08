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
        'category_id',
        'noi_dung',
    ];

    public function creator()
    {
        return $this->belongsTo(Author::class, 'created_by');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
