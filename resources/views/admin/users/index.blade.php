@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">İstifadəçilər</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">İstifadəçilər</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İstifadəçi adı</th>
                                        <th>Yazdığı rəy sayı</th>
                                        @if ($role == 'doctor')
                                            <th>Ixtisas</th>
                                        @endif
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $user->name }} @if (!$user->status)
                                                <span class="badge bg-success">Verified</span>
                                            @endif</td>
                                            <td>{{ count($user->comments) }}</td>
                                            @if ($role == 'doctor')
                                                <td>@foreach ($user->professions as $key=>$profession)
                                                    {{ $profession->name . ($key != count($user->professions)-1 ? ', ' : '') }}
                                                @endforeach</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('user.posts', $user->id) }}" class="btn btn-warning">
                                                    <i class="mdi mdi-transcribe"></i>
                                                </a>
                                                <a href="{{ route('user.comments', $user->id) }}" class="btn btn-dark">
                                                    <i class="mdi mdi-comment"></i>
                                                </a>
                                                <a href="{{ route('admin.user-edit', $user->id) }}" class="btn btn-info">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('admin.user-delete', $user->id) }}"
                                                    class="btn btn-danger delete">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('manage/assets/js/swal.js') }}"></script>
@endpush
