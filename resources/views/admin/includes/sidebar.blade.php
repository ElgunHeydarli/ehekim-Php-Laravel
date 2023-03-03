<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
        <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}"><img style="width:200px;"
                src="{{ asset('manage/images/logistika.svg') }}" alt="logo"
                style="width: 100%; height:80px; object-fit:cover; filter:invert(1)" /></a>
        <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('dashboard') }}"><img
                src="{{ asset('manage/images/favicon.png') }}" alt="logo" style="object-fit:cover;" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('admin.profile') }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('manage/images/logistika.svg') }}" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column pr-3">
                    <span class="font-weight-medium mb-2">{{ auth()->user()->name }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Əsas Səhifə</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('setting') }}">
                <i class="mdi mdi-wrench menu-icon"></i>
                <span class="menu-title">Tənzimləmələr</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories') }}">
                <i class="mdi mdi-animation menu-icon"></i>
                <span class="menu-title">Mövzular</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('posts') }}">
                <i class="mdi mdi-comment-question-outline menu-icon"></i>
                <span class="menu-title">Suallar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tags') }}">
                <i class="mdi mdi-key menu-icon"></i>
                <span class="menu-title">Açar sözlər</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('professions') }}">
                <i class="mdi mdi-book-open menu-icon"></i>
                <span class="menu-title">Ixtisaslar</span>
            </a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin.navbars') }}">-->
        <!--        <i class="mdi mdi-navigation menu-icon"></i>-->
        <!--        <span class="menu-title">Navbar</span>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('banners') }}">
                <i class="mdi mdi-file-image menu-icon"></i>
                <span class="menu-title">Banner</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                <span class="menu-title">Istifadəçilər</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}?role=user">Sadə istifadəçilər</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}?role=doctor">Həkimlər</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                <span class="menu-title">Rəylər</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comments') }}?role=user">İstifadəçi rəyləri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comments') }}?role=hekim">Həkim rəyləri</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                <span class="menu-title">Ayarlar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting') }}">Sayt məlumatları</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cities') }}">Şəhərlər</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faqs') }}">Tez-tez verilən suallar</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sliders') }}">
                <i class="mdi mdi-animation menu-icon"></i>
                <span class="menu-title">Slayderlər</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('brands') }}">
                <i class="mdi mdi-image menu-icon"></i>
                <span class="menu-title">Brendlər</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('companies') }}">
                <i class="mdi mdi-credit-card menu-icon"></i>
                <span class="menu-title">Kompaniyalar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('addresses') }}">
                <i class="mdi mdi-map-marker menu-icon"></i>
                <span class="menu-title">Ünvanlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('blogs') }}">
                <i class="mdi mdi-newspaper menu-icon"></i>
                <span class="menu-title">Xəbərlər</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('galleries') }}">
                <i class="mdi mdi-folder-image menu-icon"></i>
                <span class="menu-title">Qalareya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vacancies') }}">
                <i class="mdi mdi-account-search menu-icon"></i>
                <span class="menu-title">Vakansiyalar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('messages') }}">
                <i class="mdi mdi-message menu-icon"></i>
                <span class="menu-title">Mesajlar</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Çıxış</span>
            </a>
        </li>
    </ul>
</nav>
