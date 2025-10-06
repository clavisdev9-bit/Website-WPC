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

    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'category_id'); 
        // relasi: 1 kategori punya banyak blog
    }
}
