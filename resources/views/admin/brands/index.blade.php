@extends('admin.layouts.layout')

@php
$counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Brendlər</h3>
            <a href="{{ route('brand.create') }}" class="btn btn-success"> <i class="mdi mdi-plus"></i> </a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Brendlər</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Şəkil</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/brands/' . $brand->image) }}"  alt="">
                                            </td>
                                            <td>
                                                <a href="{{ route('brand.delete', $brand->id) }}"
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
