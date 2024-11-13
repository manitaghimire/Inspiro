<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class save extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['upload_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
