<head>
    <style>
        .admin-nav {
            background-color: #460202; 
            border-radius: 5px;
            margin-right: 10px;
        }
        .admin-nav .nav-link {
            color: #fff !important; 
        }
        .admin-nav .nav-link:hover {
            color: #000000 !important; 
        }
        .admin-nav .nav-link:hover {
            background-color: #ff006a; 
        }
    </style>
</head>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand green-after" href="{{ route('home') }}">
                <b>languageCourses</b>
            </a>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link green-after" href="{{ url('/') }}">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link green-after" href="{{ route('courses.index') }}">Kursy</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link green-after" href="#" id="coursesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rodzaje <i class="bi bi-chevron-down"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            @foreach ($courses as $course)
                                <li><a class="dropdown-item green-after" href="{{ route('courses.show', ['id' => $course->id]) }}">{{ $course->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>                              
                    <li class="nav-item">
                        <a class="nav-link green-after" href="{{ route('regulamin') }}">Regulamin</a>
                    </li>
                </ul>
                @can('is-admin')
                    <ul class="navbar-nav admin-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.enrollment') }}">Zapisy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users') }}">Edycja użytkowników</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.courses') }}">Edycja kursów</a>
                        </li>
                    </ul>
                @endcan
            </div>
            <div class="dropdown" id="navbar-user">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ url(Auth::user() ? Auth::user()->avatar : 'storage/img/user.png') }}" class="rounded-circle" height="30" alt="Portrait of a User" loading="lazy"/>
                    @if (Auth::check())
                        <span class="ms-2" style="color: inherit; text-decoration: none;">
                            {{ Auth::user()->name }}
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    @if (Auth::check())
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Mój profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.cart') }}">Koszyk</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.settings') }}">Ustawienia</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Wyloguj się</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login') }}">Zaloguj się</a></li>
                    @endif
                </ul>
            </div>            
            @include('layouts.success-toast')
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>