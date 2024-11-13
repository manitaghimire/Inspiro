<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['upload_id','tag'];
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
