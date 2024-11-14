<?php
namespace App\Orchid\Screens;


use Orchid\Screen\Screen;
use App\Models\Post;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;

class PostEditScreen extends Screen
{
    public $name = 'Edit Post';
    public $description = 'Create or edit a blog post';

    public function query(Post $post): array
    {
        return [
            'post' => $post, // Verilen post'u düzenlemek için alıyoruz.
        ];
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
                Input::make('post.title')
                    ->title('Title')
                    ->placeholder('Enter the post title')
                    ->required(),

                Quill::make('post.body')
                    ->title('Body')
                    ->placeholder('Enter the post content')
                    ->required(),
            ]),
        ];
    }

    public function save(Post $post)
    {
        $post->fill(request()->get('post'))->save();

        return redirect()->route('platform.post.list');
    }
}
