<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
class Setting extends Model
{
    use AsSource,Attachable;

    protected $fillable = ['key', 'value'];
}
