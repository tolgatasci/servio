<?php

namespace App\Orchid\Screens;

use App\Models\Form;
use App\Models\Service;
use App\Models\Subcategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class ServiceCreateScreen extends Screen
{
    public $name = 'Create Service';
    public $description = 'Create a new service';

    public $forms;

    public function query(): array
    {
        // Yeni bir servis oluştururken mevcut verilerle dolduruyoruz
        $this->forms = Form::pluck('name', 'id')->toArray();
        return [
            'forms' => $this->forms,  // Form listesini getiriyoruz
            'subcategory' => Subcategory::pluck('name', 'id'),  // Subcategory listesini getiriyoruz
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('check')
                ->method('create'),
            Button::make('Cancel')
                ->icon('close')
                ->route('platform.services'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('service.name')
                    ->title('Service Name')
                    ->placeholder('Enter service name')
                    ->required(),

                Select::make('service.subcategory_id')
                    ->title('Category')
                    ->fromModel(Subcategory::class, 'name')
                    ->required(),

                TextArea::make('service.description')
                    ->title('Description')
                    ->required(),

                Select::make('service.form_id')
                    ->title('Select Form')
                    ->options($this->forms)
                    ->help('Select the form associated with this service'),

                Picture::make('service.image')
                    ->title('Service Image')
                    ->required(), // Image field is required
            ]),
        ];
    }

    public function create(Request $request)
    {
        // Servis için doğrulama kuralları
        $request->validate([
            'service.name' => 'required|string|max:255',
            'service.subcategory_id' => 'required|exists:subcategories,id',
            'service.form_id' => 'required|exists:forms,id',
            'service.image' => 'nullable|string',
        ]);

        // Yeni servis oluşturuluyor
        $service = new Service($request->get('service'));

        // Eğer resim yüklenmişse kaydediyoruz
        if ($request->hasFile('service.image')) {
            $service->image = $request->file('service.image')->store('services');
        }

        // Veritabanına kaydediyoruz
        $service->save();

        // Kullanıcıya başarı mesajı
        Alert::info('Service created successfully.');

        // Services listesine yönlendirme
        return redirect()->route('platform.services');
    }
}
