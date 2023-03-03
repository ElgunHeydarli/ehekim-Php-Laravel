@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Mövzu əlavə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('categories') }}">Mövzular</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Ad</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Ad">
                @error('name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Slug">
                @error('slug')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Mətn</label>
                <textarea name="description" id="editor" class="form-control"></textarea>
                @error('description')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Meta title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-control"
                    placeholder="Meta title">
                @error('meta_title')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Meta description</label>
                <input type="text" name="meta_description" value="{{ old('meta_description') }}" class="form-control"
                    placeholder="Meta description">
                @error('meta_description')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Ikon</label>
                <input type="file" name="icon" accept=".svg" class="file-upload-default" />
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Şəkil yüklə" />
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button"> Şəkil yüklə </button>
                    </span>
                </div>
                @error('icon')
                    <span class="d-inline-block text-danger mt-2">{{ $message }}</span>
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
