@extends('front.layouts.layout')
@section('content')
    <div class="login-body">
        <section class="user">
            <h3 class="text-center">Qeydiyyatdan keç</h3>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    @if ($role == 'user')
                        <div class="{{ $role == 'hekim' ? 'col-md-6' : 'col-md-12' }}">
                            <div class="form-group mt-3">
                                <label for="">Ad/Ləqəb</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    @endif
                    <div class="{{ $role == 'hekim' ? 'col-md-6' : 'col-md-12' }}">
                        <div class="form-group mt-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <input type="hidden" name="role" value="{{ $role == 'hekim' ? 'doctor' : 'user' }}">
                    @if ($role == 'hekim')
                        <div class="col-md-6 ">
                            <div class="form-group mt-3">
                                <label for="">Ad</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group mt-3">
                                <label for="">Soyad</label>
                                <input type="text" class="form-control" name="lastname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="">Ixtisas</label>
                                <select name="profession_id[]" id="" class="form-control js-example-basic-multiple"
                                    style="width: 100%" multiple>
                                    <option value="">Seçim edin</option>
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="">İş təcrübəsi</label>
                                <input type="number" min="0" class="form-control" name="experience">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="">Telefon nömrəsi</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="">Qəbul qiyməti</label>
                                <input type="number" min="0" class="form-control" name="accept_price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="">Şəkil</label>
                                <input type="file" class="form-control" accept=".png,.jpg" name="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="">Həkimliyi təsdiq edən sənəd</label>
                                <input type="file" class="form-control" name="cv">
                            </div>
                        </div>
                    @endif
                    <div class="{{ $role == 'hekim' ? 'col-md-6' : 'col-md-12' }}">
                        <div class="form-group mt-3">
                            <label for="">Parol</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    @if ($role == 'hekim')
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="">Haqqında</label>
                                <textarea name="about" style="width:100%" cols="5" class="form-control"></textarea>
                            </div>
                        </div>
                    @endif

                    <input type="submit" value="Qeydiyyatdan keç" />
                </div>
            </form>
            <a href="{{ route('login') }}"> Hesabınız var? Daxil olun</a>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('account/vendor/select2/select2.min.css') }}">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('manage/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('manage/assets/js/select2.js') }}"></script>
@endpush
