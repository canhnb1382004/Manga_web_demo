<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';
    protected $primaryKey = 'chapter_id';
    protected $fillable = ['chapter_name','chapter_img','manga_name','manga_id'];

    public function manga()
    {
        return $this->belongsTo(Manga::class, 'manga_id','manga_id');
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'chapter_id');
    }
}
