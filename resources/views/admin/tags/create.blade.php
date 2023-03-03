@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Açar söz əlavə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('tags') }}">Açar sözlər</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Açar sözlər</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Açar sözlər">
                @error('name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Mətn</label>
                <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
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
