<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModelsBlogs extends Model
{
    use HasFactory;
    protected $table = 'blog_categories';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
      protected $fillable = ['name', 'slug', 'description'];

    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'category_id'); 

    }


    public static function isNameExistsAdd($name)
    {
        return self::where('name', $name)->exists();
    }

    public static function isNameExists($name, $excludeId = null)
    {
        return self::where('name', $name)
            ->where('id', '!=', $excludeId)
            ->exists();
    }
}
