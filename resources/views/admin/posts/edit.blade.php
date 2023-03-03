@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Redaktə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('posts') }}">Suallar</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Başlıq</label>
                <input type="text" value="{{ $post->title }}" name="title" class="form-control" placeholder="Başlıq">
                @error('title')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="views">Baxış sayı</label>
                <input type="text" value="{{ $post->views }}" name="views" class="form-control"
                    placeholder="Baxış sayı">
                @error('views')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Mətn</label>
                <textarea name="text" id="editor" class="form-control">{{ $post->text }}</textarea>
                @error('text')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Açar sözlər</label>
                <select name="tag_id[]" class="js-example-basic-multiple" multiple style="width: 100%;">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tag_id')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Mövzu</label>
                <select name="category_ids[]" class="js-example-basic-multiple" multiple style="width: 100%;">
                    <option value="">Seçim edin</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->categories->contains($category->id) ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">İstifadəçi</label>
                <select name="user_id" class="js-example-basic-single" style="width: 100%;">
                    <option value="">Seçim edin</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2"> Təsdiqlə </button>
        </form>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('manage/assets/vendors/select2/select2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('manage/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('manage/assets/js/select2.js') }}"></script>
@endpush
