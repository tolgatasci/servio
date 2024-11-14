<?php
namespace App\Orchid\Screens;

use App\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class CategoryEditScreen extends Screen
{
    public $name = 'Edit or Create Category';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): array
    {
        return [
            'category' => $category->exists ? $category : new Category(),
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
                Input::make('category.name')
                    ->title('Category Name')
                    ->placeholder('Enter category name')
                    ->required(),
            ]),
        ];
    }

    /**
     * Save the category.
     *
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Category $category, Request $request)
    {
        $request->validate([
            'category.name' => 'required|string|max:255',
        ]);

        $category->fill($request->get('category'))->save();

        return redirect()->route('platform.categories')
            ->with('success', 'Category saved successfully.');
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

        return redirect()->route('platform.categories')
            ->with('success', 'Category deleted.');
    }
}
