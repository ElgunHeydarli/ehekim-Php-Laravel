@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Suallar</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Suallar</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Başlıq</th>
                                        <th>Müəllif</th>
                                        <th>Kateqoriya</th>
                                        <th>Paylaşılma tarixi</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $post->title }}</td>
                                            <th>{{ $post->user ? $post->user->name : 'Anonim' }}</th>
                                            <th>{{ $post->category ? $post->category->name : 'Yoxdur' }}</th>
                                            <td>{{ $post->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('post.delete', $post->id) }}"
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
