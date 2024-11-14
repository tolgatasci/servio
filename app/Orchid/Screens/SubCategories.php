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
use App\Models\Subcategory as SubcategoryModel;
class SubCategories extends Screen
{
    public $name = 'Sub Categories';
    public $description = 'Manage Sub Categories';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'subcategories' => SubcategoryModel::all(),
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
                ->route('platform.subcategories.edit',0), // Burada ID yok
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
            Layout::table('subcategories', [
                TD::make('id', 'ID'),

                TD::make('name', 'Category Name')
                    ->render(function (SubcategoryModel $subcategory) {
                        // Düzenleme linki oluşturuluyor
                        return Link::make($subcategory->name)
                            ->route('platform.subcategories.edit', $subcategory->id)
                            ->icon('pencil'); // İsteğe bağlı olarak ikon ekleyebilirsiniz
                    }),

                TD::make('created_at', 'Created At')
                    ->render(function (SubcategoryModel $category) {
                        return $category->created_at->toDateTimeString();
                    }),

                TD::make('updated_at', 'Updated At')
                    ->render(function (SubcategoryModel $category) {
                        return $category->updated_at->toDateTimeString();
                    }),
            ]),
        ];
    }

}
