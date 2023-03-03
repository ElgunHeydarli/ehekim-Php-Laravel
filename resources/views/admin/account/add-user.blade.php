@extends('admin.layouts.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">Profil</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">İstifadəçi məlumatları</li>
            </ol>
        </nav>
    </div>
    <form class="forms-sample" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputUsername1">İstifadəçi adı</label>
            <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="exampleInputUsername1"
                placeholder="İstifadəçi adı" />
            @error('name')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1"
                placeholder="Email" />
            @error('email')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Şöbə</label>
            <select name="branch_id" class="js-example-basic-single" style="width: 100%;">
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" >{{ $branch->name }}</option>
                @endforeach
            </select>
            @error('branch_id')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">İstifadəçi növü</label>
            <select name="role" class="js-example-basic-single" style="width: 100%;">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" >{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Parol</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Parol" />
            @error('password')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mr-2"> Təsdiqlə </button>
    </form>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('manage/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manage/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('manage/assets/js/select2.js') }}"></script>
    <script src="{{ asset('manage/vendors/select2/select2.min.js') }}"></script>
@endpush
