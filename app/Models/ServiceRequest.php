<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class ServiceRequest extends Model
{
    use HasFactory,AsSource,Filterable,Attachable;

    // Filtrelenebilir sütunlar
    protected $allowedFilters = [
        'service_id',
        'entity_type',
        'name',
        'surname',
        'company_name',
        'status',
    ];

    // Sıralanabilir sütunlar
    protected $allowedSorts = [
        'service_id',
        'name',
        'surname',
        'company_name',
        'status',
        'created_at',
    ];

    protected $fillable = [
        'service_id',
        'user_id',
        'entity_type',
        'name',
        'surname',
        'company_name',
        'salutation',
        'contact_person',
        'phone',
        'fax',
        'website',
        'company_size',
        'country',
        'city',
        'district',
        'profile_image',
        'description',
        'photos', // Yeni resimler için kullanılan alan
        'status'
    ];
    function service(){
        return $this->belongsTo(Service::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
