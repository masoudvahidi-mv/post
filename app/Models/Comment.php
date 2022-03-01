<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'preview_id',
        'reply',
        'created_at',
    ];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'preview_id');
    }
}
