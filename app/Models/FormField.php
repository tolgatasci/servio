<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class FormField extends Model
{
    use HasFactory,AsSource;

    protected $fillable = ['form_step_id', 'label', 'type', 'rules','other_config','order','publish'];


    protected $casts = [
        'other_config' => 'array',
    ];
    public function step()
    {
        return $this->belongsTo(FormStep::class);
    }
}
