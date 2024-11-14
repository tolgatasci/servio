<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
class Offer extends Model
{
    use HasFactory,AsSource;
    protected $fillable = [
        'service_id',
        'service_request_id',
        'application_id',
        'sender_id',
        'receiver_id',
        'amount',
        'status',
    ];
    protected $appends = ['status_color'];
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'accepted' => 'success',
            'rejected' => 'danger',
            'waiting' => 'info',
            default => 'secondary'
        };
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class,'application_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
