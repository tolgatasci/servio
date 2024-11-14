<?php

namespace App\Orchid\Screens;


use App\Models\Category;
use App\Models\Subcategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class SubCategoriesEditScreen extends Screen
{
    public $name = 'Edit or Create Sub Category';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Subcategory $subcategory): array
    {
        return [
            'subcategory' => $subcategory ? $subcategory : new SubCategories(),
            'categories' => Category::pluck('name', 'id'), // Category modelinden seçenekleri çekiyoruz

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
                Input::make('subcategory.name')
                     ->title('Category Name')
                     ->placeholder('Enter category name')
                    ->required(),
                // Category seçimini yapmak için Select alanı ekliyoruz
                Select::make('subcategory.category_id')
                    ->title('Category')
                    ->fromModel(Category::class, 'name')
                    ->required(),
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
    public function save(Subcategory $subcategory, Request $request)
    {
        $request->validate([
            'subcategory.name' => 'required|string|max:255',
            'subcategory.category_id' => 'required|exists:categories,id', // Category ID doğrulaması
        ]);

        $subcategory->fill($request->get('subcategory'))->save();

        return redirect()->route('platform.subcategories')
            ->with('success', 'Subcategory saved successfully.');
    }

    /**
     * Remove the category.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Category $category)
    {
        $category->delete();

        return redirect()->route('platform.subcategories')
            ->with('success', 'Category deleted.');
    }
}
