@extends('front.layouts.layout')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="row">
                {{-- <div class="form-group">
                    <input type="text" class="form-control w-100" placeholder="Axtar...">
                </div> --}}
                @foreach ($posts->skip(($page - 1) * 8)->take(8) as $post)
                    <div class="col-md-6">
                        <div class="card my-2">
                            <div class="card-header">
                                <p>{{ $post->user ? $post->user->name : 'Anonim' }}</p>
                            </div>
                            <div class="card-body">
                                <h4>{{ $post->title }}</h4>
                                <p>{{ $post->text }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <p>Baxış sayı : {{ $post->views }}</p>
                                    <p>Həkim rəyi : {{ count($post->comments->whereIn('user_id', $doctors)) }}</p>
                                    <p>Paylaşılma tarixi : {{ $post->created_at->addHours(4)->format('d M H:i') }}
                                    </p>
                                    <p>
                                        @if (count($post->comments->whereIn('user_id', $doctors)) <= 2)
                                            @foreach ($post->comments->whereIn('user_id', $doctors) as $key => $doctor)
                                                {{ $doctor->name  }}
                                                rəy yazdı.
                                            @endforeach
                                        @else
                                            {{ count($post->comments->whereIn('user_id', $doctors)) }} həkim rəy yazdı.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('post-single', $post->slug) }}">Ətraflı</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    <ul class="pagination">
                        @for ($i = 1; $i <= ceil(count($posts) / 8); $i++)
                            <li class="page-item">
                                <a href="?page={{ $i }}"
                                    class="page-link {{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
