<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','slug','description','price','stock','image','is_active','category'
    ];

    // convenience accessor for image URL in views
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('frontend/img/placeholder.png');
    }
}
