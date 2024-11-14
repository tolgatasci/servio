<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory,AsSource;
    protected $fillable = ['title', 'body']; // title ve body'yi ekleyin.

}
