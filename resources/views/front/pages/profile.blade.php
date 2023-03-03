@extends('front.layouts.layout')


@section('content')
    <div class="profile-page">
        <h2>Salam, Dr {{ auth()->user()->fullname }} (Həkim üçün)</h2>

        <div class="profile-body">
            <aside class="left">
                <!--            <a href="#" class="active">-->
                <!--                Tənzimləmələr-->
                <!--            </a>-->
                <!--            <a href="#">-->
                <!--                Suallarım-->
                <!--            </a>-->
                <!--            <a href="#">-->
                <!--                Rəylərim-->
                <!--            </a>-->




                <div class="card">
                    <div class="menu active">
                        <div class="toggle">
                            <div class="line-1"></div>
                            <div class="line-2"></div>
                        </div>
                        <ul>
                            <li class="active">
                                <i class="fas fa-cog fa-lg"></i>
                                <span>Tənzimləmələr</span>
                            </li>
                            <li>
                                <i class="fa fa-question-circle fa-lg" aria-hidden="true"></i>

                                <span>Suallarım</span>
                            </li>
                            <li>
                                <i class="fa fa-comments fa-lg"></i>

                                <span>Rəylərim</span>
                            </li>
                            <li>
                                <i class="fas fa-sign-out-alt fa-lg"></i>
                                <span>Çıxış</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </aside>
            <section class="right">
                <h3>Şəxsi məlumatlarım</h3>

                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control my-3" placeholder="Ad" name="name"
                        value="{{ explode(' ', $user->fullname)[0] }}">

                    <input type="text" class="form-control my-3" placeholder="Soyad" name="lastname"
                        value="{{ count(explode(' ', $user->fullname)) > 1 ? explode(' ', $user->fullname)[1] : '' }}">
                    <input type="email" class="form-control my-3" placeholder="Email" name="email"
                        value="{{ $user->email }}">
                    <label for="">Şəkil</label>
                    <input class="form-control my-3" type="file" name="image" placeholder="Şəkil">
                    @if ($user->image)
                        <img src="{{ asset('uploads/' . $user->image) }}" width="150" height="200" alt="">
                    @endif
                    <br>

                    <label for="">Həkimliyi təsdiq edən sənəd</label>
                    <input class="form-control my-3" type="file" name="cv" placeholder="Şəkil">
                    @if ($user->cv)
                        <img src="{{ asset('uploads/' . $user->image) }}" width="150" height="200" alt="">
                    @endif
                    <br>

                    <select class="form-select my-3 js-example-basic-multiple" multiple name="profession_id[]">
                        @foreach ($professions as $profession)
                            <option value="{{ $profession->id }}"
                                {{ $user->professions->contains($profession->id) ? 'selected' : '' }}>
                                {{ $profession->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="experience" class="form-control my-3" value="{{ $user->experience }}"
                        placeholder="İş təcrübəsi">
                    <input type="tel" name="phone" class="form-control my-3" value="{{ $user->phone }}"
                        placeholder="Telefon nömrəsi">
                    <input type="number" name="accept_price" value="{{ $user->accept_price }}" class="form-control my-3"
                        placeholder="Qəbul qiyməti">
                    <textarea class="form-control my-3" id="exampleFormControlTextarea1" placeholder="Haqqımda" name="about"
                        rows="5">{{ $user->about }}</textarea>


                    <h3>Şifrəni yenilə</h3>
                    <input type="password" class="form-control my-3" name="old_password" placeholder="Köhnə şifrə">
                    <input type="password" class="form-control my-3" name="new_password" placeholder="Yeni şifrə">
                    <input type="password" class="form-control my-3" name="confirm_password"
                        placeholder="Yeni şifrənin təkrarı">
                    <button type="submit" class="btn btn-success w-100">Yadda saxla</button>
                </form>

            </section>



        </div>


    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('account/vendor/select2/select2.min.css') }}">
@endpush

@push('js')
    <script>
        let menu = document.querySelector('.menu');
        let toggle = document.querySelector('.toggle');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('manage/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('manage/assets/js/select2.js') }}"></script>
@endpush
