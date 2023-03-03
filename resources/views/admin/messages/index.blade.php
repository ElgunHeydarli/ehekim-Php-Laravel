@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Sizə gələn mesajlar</h3>
            <a href="{{ route('faq.create') }}" class="btn btn-success"> <i class="mdi mdi-plus"></i> </a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sizə gələn mesajlar</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad, Soyad</th>
                                        <th>Email</th>
                                        <th>Mövzu</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $message->fullname }}</td>
                                            <td>
                                                {{ $message->email }}
                                            </td>
                                            <td>{{ $message->fullname }}</td>
                                            <td>
                                                <a href="{{ route('message-detail', $message->id) }}" class="btn btn-info">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
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
