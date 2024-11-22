<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'gallery';
    protected $primaryKey = 'gallery_id';
    protected $fillable = ['gallery_name','chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}