@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Xəbər əlavə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Xəbərlər</a></li>
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
                <label for="description">Mətn</label>
                <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Şəkillər</label>
                <input type="file" name="images[]" accept=".png,.jpg" multiple class="file-upload-default" />
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Şəkil yüklə" />
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button"> Şəkil yüklə </button>
                    </span>
                </div>
                @error('image')
                    <span class="d-inline-block text-danger mt-2">{{ $message }}</span>
                @enderror
                <div class="upload-box"></div>
            </div>
            <div class="form-group">
                <label for="time">Tarix</label>
                <input type="date" min="{{ now()->addMonths(-1)->format('Y-m-d') }}" name="time" value="{{ old('time') }}" class="form-control" placeholder="Tarix">
                @error('time')
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
