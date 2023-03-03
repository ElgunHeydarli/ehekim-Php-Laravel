@extends('admin.layouts.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">Profil</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Menecer məlumatları</li>
            </ol>
        </nav>
    </div>
    <form method="POST">
        @csrf

        <div class="form-group">
            <label for="">Ad</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="">Soyad</label>
            <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
        </div>
        @if ($user->hasRole('garage'))
            <div class="form-group">
                <label for="">Bağlı olduğu servis işçisi</label>
                <select name="service_id" id="" class="form-control">
                    @foreach ($users as $us)
                        <option value="{{ $us->id }}" {{ $us->id == $user->service_id ? 'selected' : '' }}>
                            {{ $us->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group">
            <button class="btn btn-success update-balance" type="submit">
                Məlumatları yenilə
            </button>
        </div>
    </form>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('manage/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manage/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('manage/assets/js/select2.js') }}"></script>
    <script src="{{ asset('manage/vendors/select2/select2.min.js') }}"></script>
@endpush
