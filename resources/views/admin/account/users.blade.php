@extends('admin.layouts.layout')

@php
    $counter = 0;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">İstifadəçilər</h3>
            <a href="{{ route('add_user') }}" class="btn btn-success"> <i class="mdi mdi-plus"></i> </a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div
                            style="display: flex; align-items:center; justify-content:space-between; column-gap:20px; padding-bottom:20px;">
                            @if (in_array(1,
                                $user->roles()->pluck('role_id')->toArray()))
                                <div style="display: flex; column-gap:20px;">
                                    <h4 class="card-title active" data-id="users">Isitfadəçilər</h4>
                                    <h4 class="card-title" data-id="directors">Direktorlar</h4>
                                </div>
                            @endif
                            <input type="text" class="search form-control" placeholder="Axtar...">
                        </div>
                        <div class="table-responsive" id="users">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İstifadəçi adı</th>
                                        <th>Email</th>
                                        <th>Şöbə</th>
                                        <th>Yaradıldığı zaman</th>
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
                                            <td class="py-1">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->branch->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->addHours(4)->format('d M, Y h:i') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-user', $user->id) }}" class="btn btn-primary">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('user.delete', $user->id) }}"
                                                    class="btn btn-danger delete">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" id="directors">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İstifadəçi adı</th>
                                        <th>Email</th>
                                        <th>Şöbə</th>
                                        <th>Yaradıldığı zaman</th>
                                        <th>Proseslər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($directors as $director)
                                        @php
                                            $counter++;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td class="py-1">{{ $director->name }}</td>
                                            <td>{{ $director->email }}</td>
                                            <td>{{ $director->branch->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($director->created_at)->addHours(4)->format('d M, Y h:i') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-user', $director->id) }}" class="btn btn-primary">
                                                    <i class="mdi mdi-pen"></i>
                                                </a>
                                                <a href="{{ route('user.delete', $director->id) }}"
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

@push('css')
    <style>
        .card-title {
            padding-bottom: 10px;
            cursor: pointer;
        }

        .card-title.active {
            border-bottom: 2px solid #00cccd;
        }

        #directors{
            display: none;
        }

        .user-modal {
            position: fixed;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, .15);
            top: 0;
            left: 0;
            z-index: 9999;
            display: none;

        }

        .user-modal .modal-container {
            position: relative;
            max-width: 450px;
            min-height: 250px;
            background-color: #fff;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .15);
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
        }

        .user-modal .title h4 {
            font-size: 20px;
        }

        .search {
            width: 250px !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('manage/assets/js/swal.js') }}"></script>
    <script>
        $('.card-title').on('click', function() {
            $('.card-title').removeClass('active');
            $(this).addClass('active');
            let id = $(this).data('id');
            $('.table-responsive').hide();
            $(`#${id}`).show();
        });

        $('.detail').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            fetch(url)
                .then(res => res.text())
                .then(data => {
                    $('.user-modal').html(data).show();
                })
        });

        $(document).on('click', function(e) {
            let target = e.target;
            if (document.querySelector('.user-modal') == target) {
                $('.user-modal').hide();
            }
        });
    </script>
@endpush
