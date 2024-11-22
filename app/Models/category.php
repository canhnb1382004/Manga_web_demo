<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table ="category";
    protected $primaryKey = 'category_id';
    protected $fillable = ['category_name','category_description'];
    public function mangas()
{
    return $this->belongsToMany(Manga::class, 'category_manga', 'category_id', 'manga_id');
}

}
