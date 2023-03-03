@extends('front.layouts.layout')

@section('content')
    <section class="after-question">
        <div class="information">

            <h2>Sualınızı qeyd etdiyiniz üçün təşəkkür edirik!</h2>
            <p>Cavab gəldikdə mail vastəsilə xəbərdar olmaq üçün daxil olmağı və ya qeydiyyatdan keçməyniozi tövsiyyə
                edirik. Sualınız tam anonim paylaşılır və heç bir şəxsi məlumatınız yayımlanmır.</p>


        </div>
        <div class="register">
            <div class="left">
                <div class="top">
                    <a href="{{ route('register', 'user') }}" class="active">Qeydiyyat</a>
                    <a href="{{ route('login') }}">Hesabın var? Daxil ol</a>
                </div>
                <form action="/register/user" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="user">
                    <input type="text" name="name" id="name" placeholder="Adınız (və ya ləqəb)">
                    <input type="email" name="email" id="email" placeholder="E-poçt ünvanı">
                    <input type="password" name="password" id="password" placeholder="Şifrə">
                    <select name="gender">
                        <option value="" disabled selected>Cinsiniz</option>
                        <option value="male">Kişi</option>
                        <option value="female">Qadın</option>
                    </select>
                    <input type="submit" value="Qeydiyyatı tamamla">

                </form>
            </div>
            <a href="{{ route('home') }}" class="right">
                Sualını
                qeydiyyatsız
                göndər
            </a>
        </div>


    </section>
@endsection
