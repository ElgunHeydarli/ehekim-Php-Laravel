@extends('front.layouts.layout')

@section('title')
    {{ $setting?->meta_title }}
@endsection

@section('description')
    {{ $setting?->meta_description }}
@endsection

@section('content')
    <main>
        <div class="left">
            <div class="text">
                <h2>Sualını yaz, <span> həkimlər </span>
                    cavablasın </h2>
                <p>Sual göndərərkən adınız və ya əlaqə məlumatlarınız tələb olunmur, gizlilik qorunur.</p>




            </div>

            <form action="{{ route('add-post') }}" method="post">
                @csrf
                <input type="text" name="title" maxlength="50" id="title" placeholder="Sualınızı qeyd edin">
                <span id="input-symbol-length">50 simvol</span>
                <div class="img">
                    <img src="{{ asset('front/img/pen.png') }}" alt="pen" class="pen">
                </div>

                <textarea name="text" placeholder="Problemi ətraflı təsvir edin" id="textarea"></textarea>
                <div class="img-text">
                    <img src="{{ asset('front/img/pen.png') }}" alt="pen" class="pen">
                </div>

                <input type="submit"  value="Sualını göndər">
            
            </form>

        
    </script>


        </div>

        <div class="right">
            <img src="{{ asset('front/img/cover.svg') }}" alt="Background">
        </div>

    </main>
    <section>
        <article class="themes">
            <h5>Mövzular</h5>

            <div class="tags">
                @foreach ($categories as $category)
                    <a href="{{ route('post-single', $category->slug) }}" class="tag">{{ $category->name }}</a>
                @endforeach

            </div>








        </article>
        <article class="final-questions">
            <h5>Son suallar</h5>
            <div class="question-carts">
                @foreach ($posts as $post)
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
                    <div class="question-cart">
                        <div class="author">
                            {{ $post->user ? $post->user->name : 'Gizli istifadəçi' }}
                        </div>
                        <a href="{{ route('post-single', $post->slug) }}" class="body">
                            <h4>{{ $post->title }}</h4>
                            <p>{{ Str::limit($post->text, 50, '...') }}</p>
                        </a>
                        <div class="footer">
                            <span>{{ count($post->comments->whereIn('user_id', $doctors->pluck('id')->toArray())) }} həkim
                                rəyi</span>
                            <span>{{ count($post->comments->whereIn('user_id', $users->pluck('id')->toArray())) }}
                                istifadəçi cavabı</span>
                            <span>{{ $post->views }} baxış</span>
                            <span>{{ $differ }} əvvəl</span>
                            <span>
                                @if (count($post->comments->whereIn('user_id', $doctors->pluck('id')->toArray())))
                                    @if (count($post->comments->whereIn('user_id', $doctors->pluck('id')->toArray())) <= 2)
                                        @foreach ($post->comments->whereIn('user_id', $doctors->pluck('id')->toArray()) as $key => $comment)
                                            {{ $comment->user->fullname . ($key == count($post->comments->whereIn('user_id', $doctors->pluck('id')->toArray())) - 1 ? ' ' : ' və') }}
                                        @endforeach
                                        cavabladı
                                    @else
                                        {{ count($post->comments->whereIn('user_id', $doctors->pluck('id')->toArray())) }}
                                        həkim cavabladı
                                    @endif
                                @endif
                            </span>
                        </div>


                    </div>
                @endforeach
            </div>





        </article>
        <article class="popular-doctors">
            <h5>Populyar həkimlər</h5>

            <div class="popular-doctors-items">

                <div class="slide-container swiper">
                    <div class="slide-content">
                        <div class="card-wrapper swiper-wrapper">
                            @foreach ($doctors->get() as $doctor)
                                <a href="{{ route('doctor-detail', ['profession' => $doctor->professions->first()->slug, 'slug' => $doctor->slug]) }}" class="card swiper-slide">
                                    <div class="image-content">

                                        <div class="card-image">
                                            @if ($doctor->image)
                                                <img src="{{ asset('uploads/' . $doctor->image) }}" alt=""
                                                    class="card-img">
                                            @else
                                                <img src="https://hips.hearstapps.com/hmg-prod/images/portrait-of-a-happy-young-doctor-in-his-clinic-royalty-free-image-1661432441.jpg?crop=0.66698xw:1xh;center,top&resize=1200:*"
                                                    alt="" class="card-img">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <h2 class="name">{{ $doctor->fullname }} @if ($doctor->status)
                                                (Verified)
                                            @endif
                                        </h2>
                                        <p class="description">
                                            {{ $doctor->professions->first() ? $doctor->professions->first()->name : '' }}
                                        </p>

                                    </div>

                                    <div class="card-footer">
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

                        </div>

                        <div class="swiper-button-next swiper-navBtn"></div>
                        <div class="swiper-button-prev swiper-navBtn"></div>
                        <div class="swiper-pagination"></div>
                    </div>




                </div>

            </div>

        </article>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#textarea").hide()
            $("#textarea + .img-text").hide()

            $("#title").on("input", () => {

                $("#input-symbol-length").html(50 - $("#title").val().length + " simvol")

                if ($("#title").val().length >= 50) {

                    $("#textarea").slideDown()
                    $("#textarea + .img-text").slideDown()
                    // $("#textarea").focus()

                } else {
                    $("#textarea").slideUp()
                    $("#textarea + .img-text").slideUp()

                }
            })
        })
    </script>
    <script>
        let btn = document.getElementById('send');
        let title = document.getElementById('title');
        btn.addEventListener('click', function(e) {
            let title = document.getElementById('title');
            let form = this.parentElement;
            let url = form.getAttribute('action');
            if (title.value.length > 60) {
                e.preventDefault();
                toastr["error"]('Sualın başlığı 60 simvoldan çox olmamalıdır.')

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        });

        function clearError() {
            document.getElementById('title_error').innerText = '';
        }
    </script>
@endpush
