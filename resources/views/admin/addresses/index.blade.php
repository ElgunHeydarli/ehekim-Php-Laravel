@extends('admin.layouts.layout')

@php
$counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Ünvanlar</h3>
            <a href="{{ route('address.create') }}" class="btn btn-success"> <i class="mdi mdi-plus"></i> </a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ünvanlar</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Şəhər</th>
                                        <th>Başlıq</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($addresses as $address)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $address->city->name }}</td>
                                            <td>{{ $address->title }}</td>
                                            <td>
                                                <a href="{{ route('address.edit', $address->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('address.delete', $address->id) }}"
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
