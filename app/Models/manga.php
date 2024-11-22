<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manga extends Model
{
    use HasFactory;
    protected $table = "manga";
    protected $primaryKey = "manga_id";
    protected $fillable = ['manga_name', 'manga_othername','manga_author','manga_img', 'manga_description','manga_status'];
    public function categories()
{
   
    return $this->belongsToMany(Category::class, 'category_manga', 'manga_id', 'category_id');
}
    public function chapters()
{
    return $this->hasMany(chapter::class, 'manga_id', 'manga_id')->orderBy('created_at', 'DESC');
}
    public function comments()
{
    return $this->hasMany(Comment::class, 'manga_id', 'manga_id'); // manga_id là khóa ngoại trong bảng comments
}
}
