<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
    protected $fillable=['upload_id','user_id','rating','comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
