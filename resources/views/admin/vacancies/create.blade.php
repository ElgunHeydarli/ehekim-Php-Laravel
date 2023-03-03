@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Vakansiya əlavə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('vacancies') }}">Vakansiyalar</a></li>
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
                <label for="age">Yaş</label>
                <input type="text" name="age" value="{{ old('age') }}" class="form-control"
                    placeholder="Yaş">
                @error('age')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="agreement">Müqavilə</label>
                <input type="text" name="agreement" value="{{ old('agreement') }}" class="form-control"
                    placeholder="Müqavilə">
                @error('agreement')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Vakansiya Kateqoriyası</label>
                <input type="text" name="category" value="{{ old('category') }}" class="form-control"
                    placeholder="Vakansiya Kateqoriyası">
                @error('category')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                @error('email')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="salary">Maaş</label>
                    <input type="text" name="salary" value="{{ old('salary') }}" class="form-control"
                        placeholder="Maaş">
                    @error('salary')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="work_mode">İş qrafiki</label>
                    <input type="text" name="work_mode" value="{{ old('work_mode') }}" class="form-control"
                        placeholder="İş qrafiki">
                    @error('work_mode')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="experience">Təcrübə</label>
                    <input type="text" name="experience" value="{{ old('experience') }}" class="form-control"
                        placeholder="Təcrübə">
                    @error('experience')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="education">Təhsil</label>
                    <input type="text" name="education" value="{{ old('education') }}" class="form-control"
                        placeholder="Təhsil">
                    @error('education')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="responsibilities">Vəzifə Öhdəlikləri</label>
                <textarea name="responsibilities" id="editor" class="form-control">{{ old('responsibilities') }}</textarea>
                @error('responsibilities')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="requirements">Tələblər</label>
                <textarea name="requirements" id="editor1" class="form-control">{{ old('requirements') }}</textarea>
                @error('requirements')
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
