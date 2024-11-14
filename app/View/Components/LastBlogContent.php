<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;

class LastBlogContent extends Component
{
    public $posts;

    public function __construct()
    {
        // Son 5 blog yazısını çekiyoruz
        $this->posts = Post::latest()->take(5)->get();
    }

    public function render()
    {
        return view('components.last-blog-content');
    }
}
