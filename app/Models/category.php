<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['catname', 'icon', 'description', 'slug'];

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}
