<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingHistory extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1, STATUS_INACTIVE = 0;

    protected $fillable = ['user_id', 'book_id', 'status'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
