@extends('front.layouts.layout')

@section('title')
    {{ $tag->name }}
@endsection

@section('description')
    {{ $tag->description }}
@endsection

@section('content')
    <div class="health-description">
        <h2 style="font-size:40px;margin-bottom: 20px;">#{{ $tag->name }}</h2>
        <p>{!! $tag->description !!}</p>


    </div>

    <section class="category-body">
        <section class="category-main">
            <h4 id="tag-result">{{ $tag->name }} ilə bağlı nəticələr</h4>

            @foreach ($tag->posts->skip(($page - 1) * 8)->take(8) as $post)
                @php
                    $doctors = \App\Models\User::whereHas('roles', function ($q) {
                        return $q->where('name', 'doctor');
                    });

                    $users = \App\Models\User::whereHas('roles', function ($q) {
                        return $q->where('name', '!=', 'doctor');
                    });
                    $doctor_comments = $post->comments->whereIn('user_id', $doctors->pluck('id')->toArray());
                    $user_comments = $post->comments->whereIn('user_id', $users->pluck('id')->toArray());

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
                        <p>{{ $post->text }}</p>
                    </div>


                    <div class="article-footer">
                        <span>{{ count($doctor_comments) }} həkim rəyi</span>
                        <span>{{ count($user_comments) }} istifadəçi cavabı</span>
                        <span>{{ $post->views }} baxış</span>
                        <span>{{ $differ }} əvvəl</span>

                    </div>
                </a>
            @endforeach



            <div class="main-pagination">
                @for ($i = 1; $i <= ceil(count($tag->posts) / 8); $i++)
                    <a href="?page={{ $i }}">{{ $i }}</a>
                @endfor
            </div>
        </section>
        <aside>
            <section class="categories">
                <h5>Mövzular</h5>
                <hr>
                <ul>
                    @foreach ($categories as $category)
                        <li><a class="{{ $category->slug == $slug ? 'active' :'' }}" href="{{ route('post-single', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>

            </section>
            <section class="banner">
                <h3>Reklam yeri</h3>
            </section>

        </aside>

    </section>
@endsection
