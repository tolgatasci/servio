<?php
namespace App\Orchid\Screens;

use App\Models\Form;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class FormListScreen extends Screen
{
    public $name = 'Forms';
    public $description = 'Manage Forms';

    public function query(): array
    {
        return [
            'forms' => Form::paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create New Form')
                ->icon('plus')
                ->route('platform.forms.create'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('forms', [
                TD::make('id', 'ID')
                    ->sort(),
                TD::make('name', 'Form Name')
                    ->sort(),
                TD::make('created_at', 'Created At')
                    ->render(function (Form $form) {
                        return $form->created_at->toDateTimeString();
                    }),
                TD::make('Actions')
                    ->render(function (Form $form) {
                        return Link::make('Edit')
                            ->route('platform.forms.edit', $form->id);
                    }),
            ]),
        ];
    }
}
