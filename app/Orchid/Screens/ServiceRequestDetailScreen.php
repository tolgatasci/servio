<?php
namespace App\Orchid\Screens;

use App\Models\ServiceRequest;
use App\Models\Service;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class ServiceRequestDetailScreen extends Screen
{
    public $name = 'Service Request Details';
    public $description = 'Service request details and approval';
    public $serviceRequest;
    public $services;
    // Verileri query ile çekiyoruz
    public function query($id): array
    {
        $this->serviceRequest = ServiceRequest::findOrFail($id);
        $this->services = Service::pluck('name', 'id')->toArray();
        return [
            'serviceRequest' => $this->serviceRequest,
            'services' => $this->services, // Servis seçim listesi
        ];
    }

    // Üstteki butonlar: Kaydet, Onayla, Reddet
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('save'), // Kaydetme işlemi

            Button::make('Approve')
                ->icon('check')
                ->method('approve')
                ->confirm('Are you sure you want to approve this service request?'),

            Button::make('Reject')
                ->icon('close')
                ->method('reject')
                ->confirm('Are you sure you want to reject this service request?'),
        ];
    }

    // Düzenlenebilir alanları gösteriyoruz
    public function layout(): array
    {
        return [
            Layout::view('components.admin.service.profile-image-upload', [
                'profile_image' => $this->serviceRequest->profile_image ?? '',
            ]),
            // Formdaki diğer alanları düzenliyoruz
            Layout::rows([

                Select::make('serviceRequest.service_id')
                    ->title('Service')
                    ->options($this->services)
                    ->help('Select the correct service'),

                Input::make('serviceRequest.name')
                    ->title('Name')
                    ->canSee($this->serviceRequest->entity_type === 'individual'),

                Input::make('serviceRequest.surname')
                    ->title('Surname')
                    ->canSee($this->serviceRequest->entity_type === 'individual'),

                Input::make('serviceRequest.company_name')
                    ->title('Company Name')
                    ->canSee($this->serviceRequest->entity_type === 'company'),

                Input::make('serviceRequest.phone')
                    ->title('Phone'),

                Input::make('serviceRequest.website')
                    ->title('Website')
                    ->canSee($this->serviceRequest->entity_type === 'company'),

                Input::make('serviceRequest.company_size')
                    ->title('Company Size')
                    ->canSee($this->serviceRequest->entity_type === 'company'),




                TextArea::make('serviceRequest.description')
                    ->title('Description'),
            ]),

            // Resimlerin yönetimi için Layout::view() kullanıyoruz
            Layout::view('components.photo-management', [
                'photos' => json_decode($this->serviceRequest->photos, true) ?? [],
            ]),


        ];
    }


    public function save($id, Request $request)
    {
        $request->validate([
            'serviceRequest.service_id' => 'required|exists:services,id',
            'serviceRequest.name' => 'nullable|string|max:255',
            'serviceRequest.surname' => 'nullable|string|max:255',
            'serviceRequest.company_name' => 'nullable|string|max:255',
            'serviceRequest.salutation' => 'nullable|string|in:Mr,Ms',
            'serviceRequest.contact_person' => 'nullable|string|max:255',
            'serviceRequest.phone' => 'nullable|string|max:20',
            'serviceRequest.fax' => 'nullable|string|max:20',
            'serviceRequest.website' => 'nullable|url|max:255',
            'serviceRequest.company_size' => 'nullable|integer|min:1',
            'serviceRequest.country' => 'nullable|string|max:255',
            'serviceRequest.city' => 'nullable|string|max:255',
            'serviceRequest.district' => 'nullable|string|max:255',
            'serviceRequest.profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'serviceRequest.description' => 'nullable|string|max:5000',
            'new_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Servis isteğini güncelleme
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->fill($request->get('serviceRequest'));



        // Mevcut fotoğrafları json'dan çözümleme
        $existingPhotos = json_decode($serviceRequest->photos, true) ?? [];

        // Silinecek fotoğrafların indeksi formdan alınıyor
        $removePhotos = $request->input('remove_photos', []);
        foreach ($removePhotos as $index) {
            // Yolu `public` ile değiştirmek gerekebilir
            $filePath = str_replace('/storage/', 'public/', $existingPhotos[$index]);

            // Dosya siliniyor
            if (\Storage::exists($filePath)) {
                \Storage::delete($filePath);
            }

            // Fotoğrafı listeden çıkarıyoruz
            unset($existingPhotos[$index]);
        }

        // Eğer tüm fotoğraflar silindiyse
        if (empty($existingPhotos)) {
            $serviceRequest->photos = null;  // Eğer tüm fotoğraflar silindiyse alanı null yapıyoruz
        } else {
            // Sadece kalan fotoğrafları kaydediyoruz
            $serviceRequest->photos = json_encode(array_values($existingPhotos));
        }

        // Yeni fotoğrafları ekleme
        if ($request->hasFile('new_photos')) {
            $newPhotos = [];
            foreach ($request->file('new_photos') as $photo) {
                $path = $photo->store('public/service_photos');
                $newPhotos[] = \Storage::url($path);
            }
            // Yeni fotoğrafları mevcut fotoğraflarla birleştiriyoruz
            $serviceRequest->photos = json_encode(array_merge($existingPhotos, $newPhotos));
        }

        // Profil resmi kaydetme işlemi
        if ($request->hasFile('serviceRequest.profile_image')) {
            $profileImagePath = $request->file('serviceRequest.profile_image')->store('public/profil_photos');
            $serviceRequest->profile_image = \Storage::url($profileImagePath);  // Profil resminin URL'sini kaydediyoruz
        }
        // Güncellenen serviceRequest kaydediliyor
        $serviceRequest->save();

        Alert::info('Service request updated successfully.');
    }




    // Onaylama işlemi
    public function approve($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = 'approved';
        $serviceRequest->save();

        Alert::info('Service request approved.');
    }

    // Reddetme işlemi
    public function reject($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = 'rejected';
        $serviceRequest->save();

        Alert::info('Service request rejected.');
    }
}
