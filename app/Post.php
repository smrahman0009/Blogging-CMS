<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','content','category_id','featured','slug'];

    protected $dates = ['deleted_at'];

    
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
