@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Vakansiyalar</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vakansiyalar</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vakansiya</th>
                                        <th>Müraciət tarixi</th>
                                        <th>CV-ni yüklə</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vacancy->applies as $apply)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $apply->vacancy->title }}</td>
                                            <td>{{ $apply->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ asset('uploads/applies/'.$apply->cv) }}" download="{{ $apply->cv }}" class="btn btn-primary">
                                                    <i class="mdi mdi-download"></i>
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
