@extends('front.layouts.layout')

@section('title')
    Mövzular {{ $cat ? '/' . $cat->meta_title : '' }}
@endsection

@section('description')
    {{ $cat ? Str::limit($cat->meta_description, 155, '...') : '' }}
@endsection
@section('content')
    <div class="health-description">
        @if ($cat)
            <h2>{{ $cat->name }}</h2>
            <p>{!! $cat->description !!}</p>
        @endif
    </div>

    <section class="category-body">
        <section class="category-main">
            <div class="send-question">
                <input type="text" placeholder="Sualın var? Yaz və göndər, ixtisaslaşmış həkimlərdən cavab al">


            </div>

            @foreach ($posts->skip(($page - 1) * 8)->take(8) as $post)
                @php
                    $last = \Carbon\Carbon::parse(now());
                    $start = \Carbon\Carbon::parse($post->created_at);
                    $differDays = $last->diff($start)->format('%a');
                    $differHours = gmdate('H', $last->diffInSeconds($start));
                    $differMinutes = gmdate('i', $last->diffInSeconds($start));
                    $differSeconds = gmdate('s', $last->diffInSeconds($start));
                    if ($differDays) {
                        $differ = "$differDays gün";
                    } elseif ($differHours > 0) {
                        $differ = "$differHours saat";
                    } elseif ($differMinutes > 0) {
                        $differ = "$differMinutes dəqiqə";
                    } else {
                        $differ = "$differSeconds saniyə";
                    }
                @endphp
                <a href="{{ route('post-single', $post->slug) }}">
                    <span>{{ $post->user ? $post->user->name : 'Gizli istifadəçi' }}</span>
                    <div class="article-content">

                        <h3>{{ $post->title }}</h3>
                        <p>{{ Str::limit($post->text, 50, '...') }}</p>
                    </div>


                    <div class="article-footer">
                        <span>{{ count($post->comments->whereIn('user_id', $doctors)) }} həkim rəyi</span>
                        <span>{{ count($post->comments->whereIn('user_id', $users)) }} istifadəçi cavabı</span>
                        <span>{{ $post->views }} baxış</span>
                        <span>{{ $differ }} əvvəl</span>
                        <span>
                            @if (count($post->comments->whereIn('user_id', $doctors)))
                                @if (count($post->comments->whereIn('user_id', $doctors)) <= 2)
                                    @foreach ($post->comments->whereIn('user_id', $doctors) as $key => $comment)
                                        {{ $comment->user->fullname . ($key == count($post->comments->whereIn('user_id', $doctors)) - 1 ? ' ' : ' və') }}
                                    @endforeach
                                    cavabladı
                                @else
                                    {{ count($post->comments->whereIn('user_id', $doctors)) }} həkim cavabladı
                                @endif
                            @endif
                        </span>
                    </div>
                </a>
            @endforeach

            <div class="main-pagination">
                @for ($i = 1; $i <= ceil(count($posts) / 8); $i++)
                    <a href="?page={{ $i }}" class="{{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            </div>
        </section>
        <aside>
            <section class="categories">
                <h5>Mövzular</h5>
                <hr>
                <ul>
                    @foreach ($categories as $category)
                        <li class="{{ $slug == $category->slug ? 'active' : '' }}"><a
                                href="{{ route('post-single', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>

            </section>
            <section class="banner">
                @if ($banner)
                    <img src="{{ asset('uploads/banners/' . $banner->image) }}" />
                @else
                    <h3>Reklam yeri</h3>
                @endif
            </section>
            <section class="doctors-of-category">
                <h5>Bu sahənin həkimləri</h5>
                <hr>
                <div class="doctors-lists">
                    @foreach (\App\Models\User::whereIn('id', $doctors)->take(5)->get() as $doctor)
                        <a href="#" class="doctor-item">
                            <img src="{{ asset('uploads/' . $doctor->image) }}" alt="" class="doctor-img">
                            <div class="doctor-description">
                                <h5>{{ $doctor->name }}</h5>
                                <span>{{ $doctor->professions->first() ? $doctor->professions->first()->name : '' }}</span>
                            </div>
                            @php
                                $sum = 0;
                                foreach ($doctor->comments as $comment) {
                                    $sum += count($comment->likes);
                                }
                            @endphp
                            <span class="like-count">
                                {{ $sum }} bəyənmə
                            </span>
                        </a>
                    @endforeach

                </div>
            </section>
        </aside>

    </section>
@endsection
