

<nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="{{ route('dashboard') }}"><img
                src="{{ asset('manage/images/logistika.svg') }}" alt="logo" /></a>
        <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
            <i class="mdi mdi-menu"></i>
        </button>
        {{-- <ul class="navbar-nav">
            <li class="nav-item dropdown d-none d-sm-flex">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count  count-varient2">{{ count($messages) }}</span>
                </a>
                <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list"
                    aria-labelledby="messageDropdown">
                    @if (!count($messages))
                        <h6>Oxunmamış mesaj yoxdur</h6>
                    @else
                        <h6 class="p-3 mb-0 ">Son mesajlar</h6>
                        @foreach ($messages->take(3) as $message)
                            <a class="dropdown-item preview-item">
                                <div class="preview-item-content flex-grow">
                                    <span class="badge badge-pill badge-success">Mesaj</span>
                                    <p class="text-small text-muted ellipsis mb-0">{{ $message->subject }}
                                        {{ $message->name }} tərəfindən</p>
                                </div>
                                <p class="text-small text-muted align-self-start">
                                    {{ \Carbon\Carbon::parse($message->created_at)->addHours(4)->format('d-M-Y h:i') }}
                                </p>
                            </a>
                        @endforeach
                        <h6 class="p-3 mb-0 ">
                            <a href="{{ route('messages') }}">Bütün mesajlara bax</a>
                        </h6>
                    @endif
                </div>
            </li>
            <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
                <form class="nav-link form-inline mt-2 mt-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Axtar...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </li>
        </ul> --}}
        <ul class="navbar-nav navbar-nav-right ml-lg-auto">
            <li class="nav-item  nav-profile dropdown border-0">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                    data-toggle="dropdown">
                    <img class="nav-profile-img mr-2" alt="" src="{{ asset('manage/images/logistika.svg') }}">
                    <span class="profile-name">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="mdi mdi-cached mr-2 text-success"></i>Profilə bax</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="mdi mdi-logout mr-2 text-primary"></i> Çıxış </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
