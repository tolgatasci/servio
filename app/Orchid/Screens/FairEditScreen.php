<?php
namespace App\Orchid\Screens;

use App\Models\Fair;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class FairEditScreen extends Screen
{
    public $name = 'Fuarı Düzenle';
    public $description = 'Fuar bilgilerini düzenleyin';

    public function query(Fair $fair): iterable
    {
        return [
            'fair' => $fair,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Kaydet')
                ->icon('check')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('fair.name')
                    ->title('Fuar Adı')
                    ->required(),

                Input::make('fair.location')
                    ->title('Konum')
                    ->required(),

                DateTimer::make('fair.start_date')
                    ->title('Başlangıç Tarihi')
                    ->format('Y-m-d')
                    ->required(),

                DateTimer::make('fair.end_date')
                    ->title('Bitiş Tarihi')
                    ->format('Y-m-d')
                    ->required(),
            ]),
        ];
    }

    public function save(Fair $fair, Request $request)
    {
        $fair->fill($request->get('fair'))->save();

        return redirect()->route('platform.fairs.list');
    }
}
