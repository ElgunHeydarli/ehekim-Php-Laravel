@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Redaktə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('banners') }}">Bannerlər</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Şəkillər</label>
                <input type="file" name="image" accept=".png,.jpg" multiple class="file-upload-default" />
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Şəkil yüklə" />
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button"> Şəkil yüklə </button>
                    </span>
                </div>
                @error('image')
                    <span class="d-inline-block text-danger mt-2">{{ $message }}</span>
                @enderror
                <div class="upload-box">
                    <div class="image-box">
                        <img src="{{ asset('uploads/banners/' . $brand->image) }}" width="150" alt="">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
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
