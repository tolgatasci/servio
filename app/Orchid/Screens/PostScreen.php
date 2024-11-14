<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class PostScreen extends Screen
{
    public $name = 'Manage Posts';
    public $description = 'Create, edit, and delete posts';

    public function query(): array
    {
        return [
            'posts' => Post::paginate(), // Post'ları çekiyoruz.
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create New Post')
                ->icon('plus')
                ->route('platform.post.create'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('posts', [
                TD::make('id', 'ID'),
                TD::make('title', 'Title'),
                TD::make('created_at', 'Created At')
                    ->render(function (Post $post) {
                        return $post->created_at->toDateTimeString();
                    }),
                TD::make('actions', 'Actions')
                    ->render(function (Post $post) {
                        return implode(' ', [
                            Link::make('Edit')
                                ->route('platform.post.edit', $post->id)
                                ->icon('pencil'),

                            Button::make('Delete')
                                ->icon('trash')
                                ->confirm('Are you sure you want to delete this post?')
                                ->method('remove', ['id' => $post->id])
                                ->class('btn btn-danger'),
                        ]);
                    }),
            ]),
        ];
    }

    // Silme metodu
    public function remove(Post $post)
    {
        $post->delete();

        return redirect()->route('platform.post.list');
    }
}
