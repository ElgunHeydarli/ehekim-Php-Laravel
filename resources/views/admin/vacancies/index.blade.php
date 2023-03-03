@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Vakansiyalar</h3>
            <a href="{{ route('vacancy.create') }}" class="btn btn-success"> <i class="mdi mdi-plus"></i> </a>
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
                                        <th>Başlıq</th>
                                        <th>Kateqoriya</th>
                                        <th>Maaş</th>
                                        <th>Paylaşılma tarixi</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vacancies as $vacancy)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $vacancy->title }}</td>
                                            <td>{{ $vacancy->category }} </td>
                                            <td>{{ $vacancy->salary }}</td>
                                            <td>{{ $vacancy->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('vacancy-applies', $vacancy->id) }}" class="btn btn-info">
                                                    <i class="mdi mdi-account-search-outline"></i>
                                                </a>
                                                <a href="{{ route('vacancy.edit', $vacancy->id) }}" class="btn btn-primary">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('vacancy.delete', $vacancy->id) }}"
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
