@extends('front.layouts.layout')

@section('title')
    {{ $post->title }}
@endsection

@section('description')
    {!! Str::limit($post->text, 155, '...') !!}
@endsection

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


@section('content')

    <section class="category-body" style="padding-top: 24px;">
        <section class="question-detail">
            <section class="question">
                <div class="top">
                    <div class="left">
                        <div class="user-profile-photo"
                            style="background-image:url('https://st3.depositphotos.com/1767687/16607/v/450/depositphotos_166074422-stock-illustration-default-avatar-profile-icon-grey.jpg')">
                        </div>
                        <span>{{ $post->user ? $post->user->name : 'gizli istifadəçi' }}</span>
                    </div>
                    <div class="right">
                        <span>{{ count($doctor_comments) }} həkim rəyi</span>
                        <span>{{ count($user_comments) }} istifadəçi cavabı</span>
                        <span>{{ $post->views }} baxış</span>
                        <span>{{ $differ }} əvvəl</span>
                    </div>
                </div>
                <div class="body">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->text }}</p>
                </div>
                <div class="bottom">
                    <span>Əlaqəli</span>
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('post-single', $tag->slug) }}">#{{ $tag->name }}</a>
                    @endforeach
                </div>
            </section>
            <section class="comments">
                @if (count($doctor_comments))
                    @foreach ($doctor_comments as $comment)
                        @php
                            $last = \Carbon\Carbon::parse(now());
                            $start = \Carbon\Carbon::parse($comment->created_at);
                            $days = $last->diff($start)->format('%a');
                            $hours = gmdate('H', $last->diffInSeconds($start));
                            $minutes = gmdate('i', $last->diffInSeconds($start));
                            $seconds = gmdate('s', $last->diffInSeconds($start));
                            if ($days) {
                                $diff = "$days gün";
                            } elseif ($hours > 0) {
                                $diff = "$hours saat";
                            } elseif ($minutes > 0) {
                                $diff = "$minutes dəqiqə";
                            } else {
                                $diff = "$seconds saniyə";
                            }
                        @endphp
                        <div class="comment-item">
                            <div>
                                <div class="left">
                                    <div class="user-profile-photo"
                                        style="background-image:url('{{ 'uploads/' . $comment->user->image }}')">
                                    </div>
                                </div>
                                <div class="center">
                                    <div class="top">
                                        <span class="doctor-name">{{ $comment->user->name }}
                                            {{ $comment->user->status ? '(verified)' : '' }}</span>
                                        @if ($comment->user->hasRole('doctor'))
                                            <span
                                                class="doctor-branch">{{ $comment->user->professions->first() ? $comment->user->professions->first()->name : '' }}</span>
                                        @endif


                                    </div>
                                    <div class="center">
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                    <div class="bottom">
                                        <span class="when-added">{{ $diff }} əvvəl </span>
                                    </div>
                                </div>
                            </div>

                            @if (auth()->check())
                                <div class="right">
                                    <a href="#" class="like-comment" data-id="{{ $comment->id }}">

                                        <span class="center">
                                            <span>{{ count($comment->likes) }}</span>
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.75 6.75V15.75H0.75V6.75H3.75ZM6.75 15.75C6.35218 15.75 5.97064 15.592 5.68934 15.3107C5.40804 15.0294 5.25 14.6478 5.25 14.25V6.75C5.25 6.3375 5.415 5.9625 5.6925 5.6925L10.6275 0.75L11.4225 1.545C11.625 1.7475 11.7525 2.025 11.7525 2.3325L11.73 2.5725L11.0175 6H15.75C16.1478 6 16.5294 6.15804 16.8107 6.43934C17.092 6.72064 17.25 7.10218 17.25 7.5V9C17.25 9.195 17.2125 9.375 17.145 9.5475L14.88 14.835C14.655 15.375 14.1225 15.75 13.5 15.75H6.75ZM6.75 14.25H13.5225L15.75 9V7.5H9.1575L10.005 3.51L6.75 6.7725V14.25Z"
                                                    fill="#222222" />
                                            </svg>
                                        </span>
                                        <span
                                            class="like-answer">{{ !$comment->likes->where('user_id', auth()->id())->first() ? 'cavabı bəyən' : 'bəyənməni geri götür' }}</span>

                                    </a>
                                </div>
                            @else
                                <div class="right">
                                    <a href="#" class="like-comment" data-id="{{ $comment->id }}">

                                        <span class="center">
                                            <span>{{ count($comment->likes) }}</span>
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.75 6.75V15.75H0.75V6.75H3.75ZM6.75 15.75C6.35218 15.75 5.97064 15.592 5.68934 15.3107C5.40804 15.0294 5.25 14.6478 5.25 14.25V6.75C5.25 6.3375 5.415 5.9625 5.6925 5.6925L10.6275 0.75L11.4225 1.545C11.625 1.7475 11.7525 2.025 11.7525 2.3325L11.73 2.5725L11.0175 6H15.75C16.1478 6 16.5294 6.15804 16.8107 6.43934C17.092 6.72064 17.25 7.10218 17.25 7.5V9C17.25 9.195 17.2125 9.375 17.145 9.5475L14.88 14.835C14.655 15.375 14.1225 15.75 13.5 15.75H6.75ZM6.75 14.25H13.5225L15.75 9V7.5H9.1575L10.005 3.51L6.75 6.7725V14.25Z"
                                                    fill="#222222" />
                                            </svg>
                                        </span>
                                        <span
                                            class="like-answer">{{ !array_key_exists($comment->id, session()->get('likes', [])) ? 'cavabı bəyən' : 'bəyənməni geri götür' }}</span>

                                    </a>
                                </div>
                            @endif

                        </div>
                    @endforeach
                @endif
                @if (count($user_comments))
                    @foreach ($user_comments as $comment)
                        @php
                            $last = \Carbon\Carbon::parse(now());
                            $start = \Carbon\Carbon::parse($comment->created_at);
                            $days = $last->diff($start)->format('%a');
                            $hours = gmdate('H', $last->diffInSeconds($start));
                            $minutes = gmdate('i', $last->diffInSeconds($start));
                            $seconds = gmdate('s', $last->diffInSeconds($start));
                            if ($days) {
                                $diff = "$days gün";
                            } elseif ($hours > 0) {
                                $diff = "$hours saat";
                            } elseif ($minutes > 0) {
                                $diff = "$minutes dəqiqə";
                            } else {
                                $diff = "$seconds saniyə";
                            }
                        @endphp
                        <div class="comment-item">
                            <div>
                                <div class="left">
                                    <div class="user-profile-photo"
                                        style="background-image:url('{{ 'uploads/' . $comment->user->image }}')">
                                    </div>
                                </div>
                                <div class="center">
                                    <div class="top">
                                        <span class="doctor-name">{{ $comment->user->name }}</span>
                                        @if ($comment->user->hasRole('doctor'))
                                            <span
                                                class="doctor-branch">{{ $comment->user->professions->first() ? $comment->user->professions->first()->name : '' }}</span>
                                        @endif




                                    </div>

                                    <div class="center">
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                    <div class="bottom">
                                        <span class="when-added">{{ $diff }} əvvəl </span>
                                        @if ($comment->user_id == auth()->id())
                                            <span class="edit-comment">
                                                <svg enable-background="new 0 0 19 19" height="19px" id="Layer_1"
                                                    version="1.1" viewBox="0 0 19 19" width="19px" xml:space="preserve"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g>
                                                        <path
                                                            d="M8.44,7.25C8.348,7.342,8.277,7.447,8.215,7.557L8.174,7.516L8.149,7.69   C8.049,7.925,8.014,8.183,8.042,8.442l-0.399,2.796l2.797-0.399c0.259,0.028,0.517-0.007,0.752-0.107l0.174-0.024l-0.041-0.041   c0.109-0.062,0.215-0.133,0.307-0.225l5.053-5.053l-3.191-3.191L8.44,7.25z"
                                                            fill="#231F20" />
                                                        <path
                                                            d="M18.183,1.568l-0.87-0.87c-0.641-0.641-1.637-0.684-2.225-0.097l-0.797,0.797l3.191,3.191l0.797-0.798   C18.867,3.205,18.824,2.209,18.183,1.568z"
                                                            fill="#231F20" />
                                                        <path
                                                            d="M15,9.696V17H2V2h8.953l1.523-1.42c0.162-0.161,0.353-0.221,0.555-0.293   c0.043-0.119,0.104-0.18,0.176-0.287H0v19h17V7.928L15,9.696z"
                                                            fill="#231F20" />
                                                    </g>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <form action="{{ route('edit-comment', $comment->id) }}" method="POST"
                                        style="width:600px;" class="edit-comment-form">
                                        @csrf
                                        <input type="text" name="text" placeholder="Rəy yaz..."
                                            value="{{ $comment->text }}" style="width:60%">
                                        <input type="submit" value="Rəyi editlə"
                                            style="width: 20%; padding: 10px; background: #0065E0; color: #fff;">
                                    </form>
                                </div>
                            </div>

                            @if (auth()->check())
                                <div class="right">
                                    <a href="#" class="like-comment" data-id="{{ $comment->id }}">

                                        <span class="center">
                                            <span>{{ count($comment->likes) }}</span>
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.75 6.75V15.75H0.75V6.75H3.75ZM6.75 15.75C6.35218 15.75 5.97064 15.592 5.68934 15.3107C5.40804 15.0294 5.25 14.6478 5.25 14.25V6.75C5.25 6.3375 5.415 5.9625 5.6925 5.6925L10.6275 0.75L11.4225 1.545C11.625 1.7475 11.7525 2.025 11.7525 2.3325L11.73 2.5725L11.0175 6H15.75C16.1478 6 16.5294 6.15804 16.8107 6.43934C17.092 6.72064 17.25 7.10218 17.25 7.5V9C17.25 9.195 17.2125 9.375 17.145 9.5475L14.88 14.835C14.655 15.375 14.1225 15.75 13.5 15.75H6.75ZM6.75 14.25H13.5225L15.75 9V7.5H9.1575L10.005 3.51L6.75 6.7725V14.25Z"
                                                    fill="#222222" />
                                            </svg>
                                        </span>
                                        <span
                                            class="like-answer">{{ !$comment->likes->where('user_id', auth()->id())->first() ? 'cavabı bəyən' : 'bəyənməni geri götür' }}</span>

                                    </a>
                                </div>
                            @else
                                <div class="right">
                                    <a href="#" class="like-comment" data-id="{{ $comment->id }}">

                                        <span class="center">
                                            <span>{{ count($comment->likes) }}</span>
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.75 6.75V15.75H0.75V6.75H3.75ZM6.75 15.75C6.35218 15.75 5.97064 15.592 5.68934 15.3107C5.40804 15.0294 5.25 14.6478 5.25 14.25V6.75C5.25 6.3375 5.415 5.9625 5.6925 5.6925L10.6275 0.75L11.4225 1.545C11.625 1.7475 11.7525 2.025 11.7525 2.3325L11.73 2.5725L11.0175 6H15.75C16.1478 6 16.5294 6.15804 16.8107 6.43934C17.092 6.72064 17.25 7.10218 17.25 7.5V9C17.25 9.195 17.2125 9.375 17.145 9.5475L14.88 14.835C14.655 15.375 14.1225 15.75 13.5 15.75H6.75ZM6.75 14.25H13.5225L15.75 9V7.5H9.1575L10.005 3.51L6.75 6.7725V14.25Z"
                                                    fill="#222222" />
                                            </svg>
                                        </span>
                                        <span
                                            class="like-answer">{{ !array_key_exists($comment->id, session()->get('likes', [])) ? 'cavabı bəyən' : 'bəyənməni geri götür' }}</span>

                                    </a>
                                </div>
                            @endif

                        </div>
                    @endforeach
                @endif
            </section>
            <section class="reply">
                <h5>Cavabla</h5>
                @if (auth()->check())
                    <form action="{{ route('send-comment', $post->id) }}" method="POST">
                        @csrf
                        <input type="text" name="text" placeholder="Rəy yaz..." style="width:80%">
                        <input type="submit" value="Göndər"
                            style="width: 10%; padding: 10px; background: #0065E0; color: #fff;">
                    </form>
                @else
                    <div class="buttons-body">
                        <div class="title">Cavablamaq üçün daxil olmalı / qeydiyyatdan keçməlisiniz</div>
                        <div class="buttons">
                            <a href="{{ route('login') }}">Həkim girişi / qeydiyyatı</a>
                            <a href="{{ route('login') }}">İstifadəçi girişi / qeydiyyatı</a>
                        </div>
                    </div>
                @endif
            </section>

        </section>
        <aside>
            <a href="{{ route('home') }}" class="new-send-question">
                + Yeni sual göndər

            </a>
            @foreach ($post->categories as $category)
                <a href="{{ route('post-single', $category->slug) }}" class="general-health">
                    <div class="left">
                        <h3>{{ $category->name }}</h3>
                        <p>Bütün sualları gör</p>
                    </div>
                    <div class="right">
                        >
                    </div>
                </a>
            @endforeach
            <section class="doctors-of-category">
                <h5>Bu sahənin həkimləri</h5>
                <hr>
                <div class="doctors-lists">
                    @foreach ($doctors as $doctor)
                        <a href="{{ route('doctor-detail',['profession' => $doctor->professions->first()->slug, 'slug' => $doctor->slug]) }}" class="doctor-item">
                            <img src="{{ asset('uploads/' . $doctor->image) }}" alt="" class="doctor-img">
                            <div class="doctor-description">
                                <h5>{{ $doctor->fullname }} @if ($doctor->status)
                                        (Verified)
                                    @endif
                                </h5>
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
                <a class="show-all" href="{{ route('doctors') }}">Hamısını gör</a>
            </section>
            <section class="similiar-questions">
                <h5>Bənzər suallar</h5>
                <hr>
                <div class="similiar-questions-lists">
                    @foreach (\App\Models\Post::whereHas('categories', function ($q) use ($post) {
            return $q->whereIn('post_categories.id', $post->categories->pluck('id')->toArray());
        })->where('id', '!=', $post->id)->take(3)->get() as $item)
                        @php
                            $doctors = \App\Models\User::whereHas('roles', function ($q) {
                                return $q->where('name', 'doctor');
                            });
                        @endphp
                        <a href="{{ route('post-single', $item->slug) }}">{{ $item->title }}<span
                                class="count-answer">{{ count($item->comments->whereIn('user_id', $doctors->pluck('id')->toArray())) }}
                                həkim cavabı</span></a>
                    @endforeach
                </div>
            </section>
        </aside>

    </section>
@endsection

@push('css')
    <style>
        .edit-comment-form {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script>
        let edit_comments = document.querySelectorAll('.edit-comment');

        edit_comments.forEach(comment => {
            comment.addEventListener('click', function() {
                if (comment.parentElement.nextElementSibling.style.display == 'none') {
                    comment.parentElement.nextElementSibling.style.display = 'block';
                } else {
                    comment.parentElement.nextElementSibling.style.display = 'none';
                }
            })
        });
        let likes = document.querySelectorAll('.like-comment');
        likes.forEach(like => {
            like.addEventListener('click', function(e) {
                e.preventDefault();
                let id = this.getAttribute('data-id');
                let url = `/like-comment/${id}`;
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    });
            });
        });
    </script>
@endpush
