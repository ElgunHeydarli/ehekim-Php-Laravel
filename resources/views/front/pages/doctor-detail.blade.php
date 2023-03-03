@extends('front.layouts.layout')

@section('title')
    {{ $user->fullname }}
@endsection

@section('description')
    {{ $user->fullname }}
@endsection

@section('content')
    <div class="main-doctor-profile">
        <section class="doctor-reels">
            <div class="top-buttons">
                <button id="doctor-replyies" class="active">Həkimin cavabları</button>
                <button id="doctor-about">Həkim haqqında</button>
                <button id="patients-opinions">Pasient fikirləri (10)</button>
            </div>

            <div class="doctor-reels-body">
                <div class="doctor-reply">
                    @foreach ($user->comments as $comment)
                        <div class="doctor-body-item">
                            <div class="top">
                                <div class="left">{{ $comment->created_at->addHours(4)->format('d M') }}</div>
                                <div class="right">
                                    <svg fill="#ededed" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px"
                                        viewBox="0 0 480.554 480.553" xml:space="preserve">
                                        <g>
                                            <path
                                                d="M251.093,37.38c-2.235-3.859-6.357-6.235-10.816-6.235s-8.582,2.376-10.816,6.235L1.684,430.645
                                                c-2.24,3.867-2.245,8.636-0.013,12.507s6.361,6.257,10.83,6.257h455.553c4.469,0,8.598-2.386,10.83-6.257
                                                c2.231-3.871,2.227-8.641-0.014-12.507L251.093,37.38z M34.186,424.409L240.276,68.585l206.091,355.824H34.186L34.186,424.409z" />
                                        </g>
                                    </svg>
                                    <span>0</span>
                                </div>
                            </div>
                            <div class="center">
                                <div class="name">
                                    <div class="doctor-img"
                                        style="background-image: url('{{ asset('uploads/' . $user->image) }}')">
                                    </div>
                                    <span>{{ $user->fullname }}</span>
                                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 122.88 116.87">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #10a64a;
                                                    fill-rule: evenodd;
                                                }

                                                .cls-2 {
                                                    fill: #fff;
                                                }
                                            </style>
                                        </defs>
                                        @if ($user->status)
                                            <title>verified-symbol</title>
                                        @endif
                                        <polygon class="cls-1"
                                            points="61.37 8.24 80.43 0 90.88 17.79 111.15 22.32 109.15 42.85 122.88 58.43 109.2 73.87 111.15 94.55 91 99 80.43 116.87 61.51 108.62 42.45 116.87 32 99.08 11.73 94.55 13.73 74.01 0 58.43 13.68 42.99 11.73 22.32 31.88 17.87 42.45 0 61.37 8.24 61.37 8.24" />
                                        <path class="cls-2"
                                            d="M37.92,65c-6.07-6.53,3.25-16.26,10-10.1,2.38,2.17,5.84,5.34,8.24,7.49L74.66,39.66C81.1,33,91.27,42.78,84.91,49.48L61.67,77.2a7.13,7.13,0,0,1-9.9.44C47.83,73.89,42.05,68.5,37.92,65Z" />
                                    </svg>
                                    <span>left an answer</span>
                                </div>
                                <p>{{ $comment->text }}</p>
                            </div>
                            <div class="bottom">
                                <div class="left">
                                    <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
                                        text-rendering="geometricPrecision" image-rendering="optimizeQuality"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 379.51">
                                        <path
                                            d="M299.73 345.54c81.25-22.55 134.13-69.68 147.28-151.7 3.58-22.31-1.42-5.46-16.55 5.86-49.4 36.97-146.53 23.88-160.01-60.55C243.33-10.34 430.24-36.22 485.56 46.34c12.87 19.19 21.39 41.59 24.46 66.19 13.33 106.99-41.5 202.28-137.82 247.04-17.82 8.28-36.6 14.76-56.81 19.52-10.12 2.04-17.47-3.46-20.86-12.78-2.87-7.95-3.85-16.72 5.2-20.77zm-267.78 0c81.25-22.55 134.14-69.68 147.28-151.7 3.58-22.31-1.42-5.46-16.55 5.86-49.4 36.97-146.53 23.88-160-60.55-27.14-149.49 159.78-175.37 215.1-92.81 12.87 19.19 21.39 41.59 24.46 66.19 13.33 106.99-41.5 202.28-137.82 247.04-17.82 8.28-36.59 14.76-56.81 19.52-10.12 2.04-17.47-3.46-20.86-12.78-2.87-7.95-3.85-16.72 5.2-20.77z" />
                                    </svg>
                                </div>
                                <div class="right">
                                    <div class="top">
                                        <div class="left">
                                            <span>asked {{ $comment->post->created_at->format('d M') }}</span>

                                        </div>
                                        <div class="right-s">
                                            <svg fill="#000" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px"
                                                viewBox="0 0 480.554 480.553" xml:space="preserve">
                                                <g>
                                                    <path
                                                        d="M251.093,37.38c-2.235-3.859-6.357-6.235-10.816-6.235s-8.582,2.376-10.816,6.235L1.684,430.645
                                                        c-2.24,3.867-2.245,8.636-0.013,12.507s6.361,6.257,10.83,6.257h455.553c4.469,0,8.598-2.386,10.83-6.257
                                                        c2.231-3.871,2.227-8.641-0.014-12.507L251.093,37.38z M34.186,424.409L240.276,68.585l206.091,355.824H34.186L34.186,424.409z" />
                                                </g>
                                            </svg>
                                            <span>0</span>
                                        </div>

                                    </div>
                                    <p>
                                        {{ $comment->post->text }}
                                    </p>
                                    <div class="bottom">
                                        <span>{{ count($comment->post->comments) }} cavab</span>
                                        <span>0 rəy</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endforeach



                </div>

                <div class="doctor-about">
                    <p>{{ $user->about }}</p>
                </div>

                <div class="patients-opinions">
                    <div class="patients-opinions-item">
                        <div class="left">
                            <div class="patients-img"
                                style="background-image: url('https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&w=1000&q=80')">
                            </div>
                        </div>
                        <div class="right">
                            <span>gizli istifadəçi</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi atque commodi
                                corporis culpa dicta, ea illo inventore laboriosam, magni minus molestias quibusdam
                                reprehenderit sapiente soluta voluptatem voluptates. Alias, vitae!</p>
                        </div>


                    </div>
                    <div class="patients-opinions-item">
                        <div class="left">
                            <div class="patients-img"
                                style="background-image: url('https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&w=1000&q=80')">
                            </div>
                        </div>
                        <div class="right">
                            <span>gizli istifadəçi</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi atque commodi
                                corporis culpa dicta, ea illo inventore laboriosam, magni minus molestias quibusdam
                                reprehenderit sapiente soluta voluptatem voluptates. Alias, vitae!</p>
                        </div>


                    </div>
                    <div class="patients-opinions-item">
                        <div class="left">
                            <div class="patients-img"
                                style="background-image: url('https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&w=1000&q=80')">
                            </div>
                        </div>
                        <div class="right">
                            <span>gizli istifadəçi</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi atque commodi
                                corporis culpa dicta, ea illo inventore laboriosam, magni minus molestias quibusdam
                                reprehenderit sapiente soluta voluptatem voluptates. Alias, vitae!</p>
                        </div>


                    </div>
                    <div class="patients-opinions-item">
                        <div class="left">
                            <div class="patients-img"
                                style="background-image: url('https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&w=1000&q=80')">
                            </div>
                        </div>
                        <div class="right">
                            <span>gizli istifadəçi</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi atque commodi
                                corporis culpa dicta, ea illo inventore laboriosam, magni minus molestias quibusdam
                                reprehenderit sapiente soluta voluptatem voluptates. Alias, vitae!</p>
                        </div>


                    </div>
                </div>

            </div>


        </section>
        <aside class="doctor-information">
            <div class="body">
                <div class="top">
                    <div class="doctor-profile-photo"
                        style="background-image: url('{{ asset('uploads/' . $user->image) }}')">
                    </div>
                    <h4>{{ $user->fullname }} @if ($user->status)
                            (verified)
                        @endif
                    </h4>
                    <p>{{ $user->professions->first() ? $user->professions->first()->name : '' }}</p>
                    <span>Baku</span>
                    <div class="footer">
                        <div class="left"><span>{{ count($user->comments) }}</span>
                            <span>
                                həkim rəyi
                            </span>
                        </div>
                        <div class="right">
                            @php
                                $sum = 0;
                                foreach ($user->comments as $comment) {
                                    $sum += count($comment->likes);
                                }
                            @endphp
                            <span>{{ $sum }}</span>
                            <span>
                                bəyənmə
                            </span>
                        </div>
                    </div>

                </div>
                <div class="divider"></div>
                <div class="bottom">
                    <a href="#">Konsultasiyaya yazıl</a>
                    <a href="#">Zəng et</a>
                </div>
            </div>

        </aside>

    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#doctor-replyies").click(() => {
                $(".doctor-reels-body > div").hide()
                $(".doctor-reply").show()
                $(".top-buttons > button").removeClass("active")
                $("#doctor-replyies").addClass("active")

            })


            $("#doctor-about").click(() => {
                $(".doctor-reels-body > div").hide()
                $(".doctor-about").show()
                $(".top-buttons > button").removeClass("active")

                $("#doctor-about").addClass("active")

            })


            $("#patients-opinions").click(() => {
                $(".doctor-reels-body > div").hide()
                $(".patients-opinions").css("display", "flex")
                $(".top-buttons > button").removeClass("active")

                $("#patients-opinions").addClass("active")

            })


        })
    </script>
@endpush
