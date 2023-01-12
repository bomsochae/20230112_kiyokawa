<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['task', 'tag_id', 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function tag() {
        return $this->belongsTo('App\Models\Tag');
    }
}
