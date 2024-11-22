<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey = 'id';
    protected $fillable = ['manga_id', 'user_id', 'content','reply_to'];

    // Định nghĩa quan hệ ngược lại với Manga (nhiều comment thuộc về một manga)
    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    // Quan hệ với User (nếu có bảng users)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' là trường trong bảng comment
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_to');
    }

    // Bình luận cha của bình luận này
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'reply_to');
    }
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'reply_to');
    }

}
