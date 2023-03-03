@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Rəylər</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Rəylər</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rəyin mətni</th>
                                        <th>Istifadəçi</th>
                                        <th>Yazdığı sual</th>
                                        <th>Tarix</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ Str::limit($comment->text, 40, '...') }}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('post-single', $comment->post->slug) }}">{{ $comment->post->title }}</a>
                                            </td>
                                            <td>{{ $comment->created_at->addHours(4)->format('d M Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-primary">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('comment.delete', $comment->id) }}"
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
