@extends('front.layouts.layout')

@section('content')
    <div class="login-body">

        <section class="user">
            <form method="POST">
                @csrf
                <h2>İstifadəçilər üçün</h2>
                <input type="text" name="email" placeholder="E-poçt ünvanı">

                <input type="password" name="password" placeholder="şifrə">
                <input type="submit" value="Daxil ol">
            </form>

            <a href="{{ route('register', 'user') }}">Hesabınız yoxdur? qeydiyyatdan keçin</a>
        </section>

        <section class="doctor">
            <form method="POST">
                @csrf
                <h2>Həkimlər üçün</h2>
                <input type="text" name="email" placeholder="E-poçt ünvanı">
                <input type="password" name="password" placeholder="şifrə">
                <input type="submit" value="Daxil ol">
            </form>

            <a href="{{ route('register', 'hekim') }}">Hesabınız yoxdur? qeydiyyatdan keçin</a>
        </section>
    </div>
@endsection
