@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Mesaja bax</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('messages') }}">Sizə gələn suallar</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fullname">Ad Soyad</label>
                <input name="fullname" class="form-control" disabled value="{{  $message->fullname  }}" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control" disabled  value="{{  $message->email  }}" />
            </div>
            <div class="form-group">
                <label for="subject">Mövzu</label>
                <input name="subject" class="form-control" disabled value="{{  $message->subject  }}" />
            </div>
            <div class="form-group">
                <label for="message">Mesaj</label>
                <textarea name="message" class="form-control">{{ $message->message }}</textarea>
            </div>
            <a href="{{ route('messages') }}" class="btn btn-primary mr-2"> Geri </a>
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
