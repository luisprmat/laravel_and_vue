<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['text', 'category_id'];

    protected $hidden = ['created_at', 'updated_at'];


    public function category() {
        $this->belongsTo(Category::class)->withDefault();
    }
}
