@extends('admin.layouts.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">Profil</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin məlumatları</li>
            </ol>
        </nav>
    </div>
    <form class="forms-sample" method="POST" >
        @csrf
        <div class="form-group">
            <label for="exampleInputUsername1">İstifadəçi adı</label>
            <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control"
                id="exampleInputUsername1" placeholder="İstifadəçi adı" />
            @error('name')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control" id="exampleInputEmail1"
                placeholder="Email" />
            @error('email')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Parolu yenilə</label>
            <input type="password" name="password" class="form-control"
                id="exampleInputPassword1" placeholder="Parolu yenilə" />
            @error('password')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Yeni parolu təkrarla</label>
            <input type="password" name="confirm_password" class="form-control"
                id="exampleInputPassword1" placeholder="Yeni parolu təkrarla" />
            @error('confirm_password')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mr-2"> Təsdiqlə </button>
    </form>
@endsection
