<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    public    $incrementing = true;
    public    $timestamps = true;
    protected $fillable = ['title', 'slug', 'content', 'excerpt',
     'author_id','category_id','image','is_published','views','meta_title','meta_description'];


     public static function isTitleExists($title)
    {
        return self::where('title', $title)->exists();
    }

    //cek apakah ada name  yang sama  untuk update
    public static function isTitleExistsup($title, $excludeId = null)
    {
        return self::where('title', $title)
            ->where('id', '!=', $excludeId)
            ->exists();
    }
}
