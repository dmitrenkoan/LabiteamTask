<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'preview_text', 'detail_text', 'preview_picture_id'
    ];

    public function previewPicture() {
        return $this->belongsTo('App\Picture', 'preview_picture_id');
    }
}
