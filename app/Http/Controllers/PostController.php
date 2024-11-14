<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Blog gönderisinin detayını gösterir.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Belirtilen id ile blog gönderisini veritabanından çekiyoruz
        $post = Post::findOrFail($id);

        // Gönderiyi 'post.show' view'ine gönderiyoruz
        return view('post.show', compact('post'));
    }
}
