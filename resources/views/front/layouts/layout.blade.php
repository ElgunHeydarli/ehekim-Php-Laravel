@php
    $setting = App\Models\Setting::first();
@endphp
<!doctype html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="@yield('description')">
    <meta name="title" content="@yield('title')">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('front/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    @stack('css')
    <style>
        .search-list li {
            list-style: none;
            margin-bottom: 5px;
            margin-left: 10px;
        }

        .search-result {
            background: #fff;
            width: 100%;
            padding: 10px;
        }
    </style>
</head>

<body>


    <header>
        <div class="left">
            <div class="logo">
                <img src="{{ asset('uploads/setting/' . $setting?->logo) }}" alt="">
            </div>
            <div style="position:relative">
                <input placeholder="Axtar" type="search" id="search">
                <div class="search-result" style="position: absolute; top:100%;z-index:9999;">

                </div>
            </div>


            <div class="links">
                <a href="{{ route('home') }}" class="{{ \Route::current()->getName() == 'home' ? 'red' : '' }}">Ana
                    Səhifə</a>
                <a href="{{ route('category-posts') }}"
                    class="{{ \Route::current()->getName() == 'category-posts' ? 'red' : '' }}">Suallar</a>
                <a href="{{ route('doctors') }}"
                    class="{{ \Route::current()->getName() == 'doctors' ? 'red' : '' }}">Həkimlər</a>
                {{-- <a href="./doctor-detail.html">Həkim Profili</a> --}}
                <a href="{{ route('post-single',\App\Models\Tag::first()?->slug) }}"
                    class="{{ \Route::current()->getName() == 'tag-post' ? 'red' : '' }}">Etiket</a>
                {{-- <a href="./question.html">Sualdan sonra</a> --}}
            </div>


        </div>
        <div class="right">

            @if (!auth()->check())
                <a href="{{ route('login') }}">Giriş / Qeydiyyat</a>
            @else
                <p style="margin-right:15px;">{{ auth()->user()->name }} </p>
                @if (auth()->user()->hasRole('doctor'))
                    <a href="{{ route('profile') }}" style="margin-right: 12px;">Profil</a>
                @endif
                <a href="{{ route('logout') }}">Çıxış ver</a>
            @endif


        </div>

    </header>

    @yield('content')
    <footer>
        <h2>FOOTER / Menyular</h2>
    </footer>








    <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>
    @stack('js')

    <script>
        let search = document.getElementById('search');
        search.addEventListener('keyup', function() {
            let text = this.value;
            if (text.length >= 2) {
                let url = `/search?search=${text}`;
                fetch(url)
                    .then(res => res.text())
                    .then(data => {
                        let result = document.querySelector('.search-result');
                        result.innerHTML = data;
                    });
            } else {
                let result = document.querySelector('.search-result');
                result.innerHTML = ``;
            }
        });
    </script>
</body>

</html>
