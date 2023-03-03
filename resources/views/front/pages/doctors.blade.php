@extends('front.layouts.layout')

@section('title')
    Hekimler / {{ $profession ? $profession->meta_title : '' }}
@endsection

@section('description')
    {{ $profession ? Str::limit($profession->meta_description, 155, '...') : '' }}
@endsection

@section('content')
    <main class="doctor-catalog-page" style="min-height:609px; height:100%">
        <section class="doctor-catalog-title">
            @if ($slug)
                <h2>{{ $profession->name }}</h2>
                <p>{!! $profession->description !!}</p>
            @endif
        </section>

        <section class="doctor-catalog-components">

            <aside class="doctor-branches">
                <nav>
                    <h5>İxstisasa gore</h5>
                    <ul>
                        @foreach ($professions as $profession)
                            <li class="{{ $profession->slug == $slug ? 'active' : '' }}">
                                <a href="{{ route('post-single', $profession->slug) }}">{{ $profession->name }}
                                    ({{ count($profession->users) }} həkim)
                                </a>
                            </li>
                        @endforeach




                    </ul>

                </nav>



            </aside>

            <section class="doctors-catalog-items">
                @foreach ($doctors->skip(($page - 1) * 16)->take(16) as $doctor)
                    <a href="{{ route('doctor-detail', ['profession' => $doctor->professions->first()->slug, 'slug' => $doctor->slug]) }}"
                        class="doctor-catalog-item">
                        <div class="doctor-img-avatar"
                            style="background-image:url({{ $doctor->image ? asset('uploads/' . $doctor->image) : 'https://img.freepik.com/free-photo/woman-doctor-wearing-lab-coat-with-stethoscope-isolated_1303-29791.jpg?w=2000' }})">
                        </div>
                        <h4>{{ $doctor->fullname }} @if ($doctor->status)
                                (Verified)
                            @endif
                        </h4>
                        <p>{{ $slug ? \App\Models\Profession::where('slug',$slug)->first()->name : ($doctor->professions->first() ? $doctor->professions->first()->name : '') }}</p>
                        <div class="doctor-item-footer">
                            <span>{{ count($doctor->comments) }} həkim məsləhəti</span>
                            @php
                                $sum = 0;
                                foreach ($doctor->comments as $comment) {
                                    $sum += count($comment->likes);
                                }
                            @endphp
                            <span>{{ $sum }} bəyənmə</span>
                        </div>
                    </a>
                @endforeach


                <div class="doctor-catalog-pagination">
                    @for ($i = 1; $i <= ceil(count($doctors) / 16); $i++)
                        <a class="active" href="?page={{ $i }}">{{ $i }}</a>
                    @endfor
                </div>


            </section>


        </section>


    </main>
@endsection
