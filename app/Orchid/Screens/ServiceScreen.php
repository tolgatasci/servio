<?php

namespace App\Orchid\Screens;

use App\Models\Service;
use Orchid\Screen\Screen;
use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ServiceScreen extends Screen
{
    public $name = 'Services';
    public $description = 'Manage Services';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'services' => Service::all(),
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
            Link::make('Create New Service')
                ->icon('plus')
                ->route('platform.services.create'), // Burada ID yok
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
            Layout::table('services', [
                TD::make('id', 'ID'),

                TD::make('name', 'Service Name')
                    ->render(function (Service $service) {
                        // Düzenleme linki oluşturuluyor
                        return Link::make($service->name)
                            ->route('platform.services.edit', $service->id)
                            ->icon('pencil'); // İsteğe bağlı olarak ikon ekleyebilirsiniz
                    }),

                TD::make('created_at', 'Created At')
                    ->render(function (Service $service) {
                        return $service->created_at->toDateTimeString();
                    }),

                TD::make('updated_at', 'Updated At')
                    ->render(function (Service $service) {
                        return $service->updated_at->toDateTimeString();
                    }),
                TD::make('image', 'Image')
                    ->render(function (Service $service) {
                        return "<img src='" . $service->image. "' alt='service image' width='100'>";
                    }),
            ]),
        ];
    }

}
