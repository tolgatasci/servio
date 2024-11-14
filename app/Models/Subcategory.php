<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Subcategory extends Model
{
    use HasFactory,AsSource;
    protected $fillable = ['name', 'category_id']; // Doldurulabilir alanları tanımlayın

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
