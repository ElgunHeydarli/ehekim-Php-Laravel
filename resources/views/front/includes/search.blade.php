@if (count($data['posts']))
    <h4 style="margin-bottom:10px;">Suallar</h4>
    <ul class="search-list">
        @foreach ($data['posts'] as $post)
            <li>
                <a href="{{ route('post-single', $post->slug) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if (count($data['doctors']))
    <h4 style="margin-bottom:10px;">Həkimlər</h4>
    <ul class="search-list">
        @foreach ($data['doctors'] as $doctor)
            <li>
                <a href="{{ route('doctor-detail',$doctor->email) }}">{{ $doctor->fullname }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if (count($data['categories']))
    <h4 style="margin-bottom:10px;">Mövzular</h4>
    <ul class="search-list">
        @foreach ($data['categories'] as $category)
            <li>
                <a href="{{ route('post-single', $category->slug) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if (count($data['tags']))
    <h4 style="margin-bottom:10px;">Açar sözlər</h4>
    <ul class="search-list">
        @foreach ($data['tags'] as $tag)
            <li>
                <a href="{{ route('post-single', $tag->slug) }}">{{ $tag->name }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if (count($data['professions']))
    <h4 style="margin-bottom:10px;">İxtisaslar</h4>
    <ul class="search-list">
        @foreach ($data['professions'] as $profession)
            <li>
                <a href="{{ route('doctors', $profession->slug) }}">{{ $profession->name }}</a>
            </li>
        @endforeach
    </ul>
@endif
