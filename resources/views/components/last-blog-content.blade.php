<div class="single-footer-widget">
    <h4>Önemli Yazılar</h4>
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
