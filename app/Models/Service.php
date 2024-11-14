<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Service extends Model
{
    use HasFactory,AsSource;

    protected $fillable = ['name','form_id','description','subcategory_id','image'];
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Servis ve form ilişkisi
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
