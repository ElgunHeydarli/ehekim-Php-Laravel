@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Ixtisas əlavə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('professions') }}">Ixtisaslar</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Başlıq</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Başlıq">
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
                <label for="description">Mətn</label>
                <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Açar sözlər</label>
                <select name="tag_id[]" class="js-example-basic-multiple" multiple style="width: 100%;">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tag_id')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Mövzular</label>
                <select name="category_id[]" class="js-example-basic-multiple" multiple style="width: 100%;">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('tag_id')
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
            <button type="submit" class="btn btn-primary mr-2"> Təsdiqlə </button>
        </form>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manage/assets/vendors/select2/select2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('manage/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('manage/assets/js/cketditor.js') }}"></script>
    <script src="{{ asset('manage/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('manage/assets/js/select2.js') }}"></script>
@endpush
