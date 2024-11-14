<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Form extends Model
{
    use HasFactory,AsSource;
    protected $table = 'forms';
    protected $fillable = ['name','private_form','blade_name'];

    public function steps()
    {
        return $this->hasMany(FormStep::class);
    }
}
