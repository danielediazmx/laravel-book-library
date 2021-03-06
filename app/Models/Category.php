<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description',];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
