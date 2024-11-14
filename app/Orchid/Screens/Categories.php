<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class Categories extends Screen
{
    public $name = 'Categories';
    public $description = 'Manage Categories';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'categories' => Category::all(),
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
            Link::make('Create New Category')
                ->icon('plus')
                ->route('platform.category.edit',0), // Burada ID yok
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
            Layout::table('categories', [
                TD::make('id', 'ID'),

                TD::make('name', 'Category Name')
                    ->render(function (Category $category) {
                        // Düzenleme linki oluşturuluyor
                        return Link::make($category->name)
                            ->route('platform.category.edit', $category->id)
                            ->icon('pencil'); // İsteğe bağlı olarak ikon ekleyebilirsiniz
                    }),

                TD::make('created_at', 'Created At')
                    ->render(function (Category $category) {
                        return $category->created_at->toDateTimeString();
                    }),

                TD::make('updated_at', 'Updated At')
                    ->render(function (Category $category) {
                        return $category->updated_at->toDateTimeString();
                    }),
            ]),
        ];
    }

}
