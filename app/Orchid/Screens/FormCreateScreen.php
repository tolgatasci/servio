<?php
namespace App\Orchid\Screens;

use App\Models\Form;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class FormCreateScreen extends Screen
{
    public $name = 'Create New Form';
    public $description = 'Create a new dynamic form';

    public function query(): array
    {
        return [];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('save'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('form.name')
                    ->title('Form Name')
                    ->placeholder('Enter the form name')
                    ->required(),
            ]),
        ];
    }

    public function save(Request $request)
    {

        $request->validate([
            'form.name' => 'required|string|max:255',
        ]);

        Form::create([
            'name' => $request->input('form.name'),
        ]);

        Alert::info('Form created successfully!');

        return redirect()->route('platform.forms'); // Listeleme ekranına yönlendiriyoruz
    }
}
