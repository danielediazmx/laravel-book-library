<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'author', 'category_id',];
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
