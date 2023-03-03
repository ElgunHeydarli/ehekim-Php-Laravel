@extends('admin.layouts.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">Sayt haqqında</h3>
    </div>
    <form class="forms-sample" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Loqo</label>
            <input type="file" name="logo" accept=".png,.jpg,.svg" class="file-upload-default" />
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Şəkil yüklə" />
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button"> Şəkil yüklə </button>
                </span>
            </div>
            @error('logo')
                <span class="d-inline-block text-danger mt-2">{{ $message }}</span>
            @enderror
            @if ($setting && $setting->logo)
                <div class="upload-box">
                    <div class="image-box">
                        <img src="{{ asset('uploads/setting/' . $setting->logo) }}" width="150" alt="">
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Meta title</label>
            <input type="text" value="{{ $setting ? $setting->meta_title : '' }}" name="meta_title" class="form-control"
                id="exampleInputUsername1" placeholder="Meta title" />
            @error('meta_title')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Meta description</label>
            <input type="text" value="{{ $setting ? $setting->meta_description : '' }}" name="meta_description" class="form-control"
                id="exampleInputUsername1" placeholder="Meta description" />
            @error('meta_description')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mr-2"> Təsdiqlə </button>
    </form>
@endsection

@push('js')
    <script src="{{ asset('manage/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('manage/assets/js/cketditor.js') }}"></script>
@endpush
