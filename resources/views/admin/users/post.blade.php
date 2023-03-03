@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">{{ $user->name }} istifadəçisinin sualları</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">İstifadəçilər</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            @if (count($posts))
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-header">{{ $post->title }}</div>
                        <div class="card-body">
                            <p>{!! $post->text !!}</p>
                        </div>
                        <div class="card-footer">
                            <span class="text-end"><b>Sualın yazılma
                                    tarixi</b>{{ $post->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Bu istifadəçinin sualları yoxdur</h3>
            @endif
        </div>
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
