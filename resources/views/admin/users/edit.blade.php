@extends('admin.layouts.layout')
@php
    if ($user->hasRole('doctor')) {
        $role = 'doctor';
    } else {
        $role = 'user';
    }
@endphp

@section('content')
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Redaktə et</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('admin.users') }}?role={{ $role }}">Istifadəçilər</a></li>
                </ol>
            </nav>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">İstifadəçi adı</label>
                <input type="text" value="{{ $user->name }}" name="name" class="form-control" placeholder="Ad">
                @error('name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="Email">
                @error('email')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            @if ($user->hasRole('doctor'))
                <div class="form-group">
                    <label>Şəkil</label>
                    <input type="file" name="image" accept=".png,.jpg" class="file-upload-default" />
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Şəkil yüklə" />
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button"> Şəkil yüklə </button>
                        </span>
                    </div>
                    @error('image')
                        <span class="d-inline-block text-danger mt-2">{{ $message }}</span>
                    @enderror
                    @if ($user->image)
                        <div class="upload-box">
                            <div class="image-box">
                                <img src="{{ asset('uploads/' . $user->image) }}" width="150" alt="">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Sənəd</label>
                    <input type="file" name="image" accept=".png,.jpg" class="file-upload-default" />
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Şəkil yüklə" />
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button"> Şəkil yüklə </button>
                        </span>
                    </div>
                    @error('cv')
                        <span class="d-inline-block text-danger mt-2">{{ $message }}</span>
                    @enderror
                    @if ($user->cv)
                        <div class="upload-box">
                            <div class="image-box">
                                <img src="{{ asset('uploads/' . $user->cv) }}" width="150" alt="">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Ad</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                </div>

                <div class="form-group">
                    <label for="">Soyad</label>
                    <input type="text" class="form-control"
                        value="{{ count(explode(' ', $user->fullname)) == 2 ? explode(' ', $user->fullname)[1] : '' }}"
                        name="lastname">
                </div>
                <div class="form-group">
                    <label for="">Ixtisas</label>
                    <select name="profession_id[]" id="" class="form-control js-example-basic-multiple" multiple>
                        <option value="">Seçim edin</option>
                        @foreach ($professions as $profession)
                            <option value="{{ $profession->id }}"
                                {{ $user->professions->contains($profession->id) ? 'selected' : '' }}>
                                {{ $profession->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">İş təcrübəsi</label>
                    <input type="number" min="0" value="{{ $user->experience }}" class="form-control"
                        name="experience">
                </div>
                <div class="form-group">
                    <label for="">Telefon nömrəsi</label>
                    <input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
                </div>
                <div class="form-group">
                    <label for="">Qəbul qiyməti</label>
                    <input type="number" min="0" class="form-control" value="{{ $user->accept_price }}"
                        name="accept_price">
                </div>
                <div class="form-group mt-3">
                    <label for="">Haqqında</label>
                    <textarea name="about" class="form-control">{{ $user->about }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Unverified</option>
                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Verified</option>
                    </select>
                </div>
            @endif
            <div class="form-group mt-3">
                <label for="">Parol</label>
                <input type="password" class="form-control" name="password">
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
