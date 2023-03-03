@extends('admin.layouts.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">Profil</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Şöbə əlavə et</li>
            </ol>
        </nav>
    </div>
    <form class="forms-sample" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputUsername1">Şöbə adı</label>
            <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="exampleInputUsername1"
                placeholder="Şöbə adı" />
            @error('name')
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
