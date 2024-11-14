<?php

namespace App\Orchid\Screens;


use App\Models\Category;
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

class ServiceEditScreen extends Screen
{
    public $name = 'Edit or Create Service';

    public $forms;
    public function query($id): array
    {

        $service = Service::with('form')->findOrFail($id);
        $this->forms = Form::pluck('name', 'id')->toArray();
        return [
            'service' => $service ? $service : new Service(),
            'subcategory' => Subcategory::pluck('name', 'id'), // Category modelinden seçenekleri çekiyoruz
            'forms' => $this->forms,

        ];
    }


    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('save'),
            Button::make('Delete')
                ->icon('trash')
                ->method('remove'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('service.name')
                    ->title('Service Name')
                    ->placeholder('Enter service name')
                    ->required(),
                // Category seçimini yapmak için Select alanı ekliyoruz
                Select::make('service.subcategory_id')
                    ->title('Category')
                    ->fromModel(Subcategory::class, 'name')
                    ->required(),
                TextArea::make('service.description')
                    ->title('Description')
                    ->required(),
                Select::make('service.form_id')
                    ->title('Select Form')
                    ->options($this->forms)  // Formları seçenekler olarak kullan
                    ->help('Select the form associated with this service'),
                // Resim yükleme alanı ekliyoruz
                Picture::make('service.image')
                    ->title('Service Image')
                    ->required(), // Zorunlu olarak işaretleyebilirsiniz
            ]),
        ];
    }

    /**
     * Save the category.
     *
     * @param Category $subcategory
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Service $service, Request $request)
    {
        $request->validate([
            'service.name' => 'required|string|max:255',
            'service.subcategory_id' => 'required|exists:subcategories,id', // Category ID doğrulaması
            'service.image' => 'nullable|string', // Resim doğrulaması, dosya kontrolü yerine yolunu kontrol ediyoruz
            'service.form_id' => 'required|exists:forms,id',
        ]);
        // Dosya yüklenmişse işlemi yapıyoruz
        if ($request->hasFile('service.image')) {
            $service->image = $request->file('service.image')->store('services');
        }
        $service->fill($request->get('service'))->save();

        return redirect()->route('platform.services')
            ->with('success', 'Subcategory saved successfully.');
    }

    /**
     * Remove the category.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Service $category)
    {
        $category->delete();

        return redirect()->route('platform.services')
            ->with('success', 'Category deleted.');
    }
}
