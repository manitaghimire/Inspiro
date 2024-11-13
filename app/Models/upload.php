<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    use HasFactory;
    protected $fillable=['title','user_id','category_id','imageurl','caption','link','average_rating','reviews','saves'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    public function reviewCollection()
    {
        return $this->hasMany(Review::class);
    }
   public function saveCollection()
   {
    return $this->hasMany(Save::class);
   }
}
