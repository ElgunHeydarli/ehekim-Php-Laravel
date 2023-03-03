@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Ünvan əlavə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('cities') }}">Ünvanlar</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Başlıq</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Başlıq">
                @error('title')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Ünvan</label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Ünvan">
                @error('address')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phones">Telefon nömrəsi</label>
                <input type="text" name="phones[]" value="{{ old('phones') }}" class="form-control"
                    placeholder="Telefon nömrəsi">
                @error('phones[]')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="schedules">Qrafiklər</label>
                <input type="text" name="schedules[]" value="{{ old('schedules') }}" class="form-control"
                    placeholder="Qrafiklər">
                @error('schedules[]')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <select name="city_id" id="" class="form-control">
                    <option value="">Şəhər seçin</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2"> Təsdiqlə </button>
        </form>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('manage/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('manage/assets/js/cketditor.js') }}"></script>
    <script src="{{ asset('manage/assets/js/file-upload.js') }}"></script>
@endpush
