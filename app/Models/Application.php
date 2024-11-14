<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
class Application extends Model
{
    use HasFactory,AsSource;
    protected $table = 'applications';
    protected $casts = [
        'form_data' => 'array',
    ];

    protected $fillable = ['form_data','user_id','service_id','form_id'];

    /**
     * Default values for attributes.
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Service ile ilişki (Bir başvuru bir servise ait olabilir).
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Form ile ilişki (Bir başvuru bir formdan gelebilir).
     */
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

}
