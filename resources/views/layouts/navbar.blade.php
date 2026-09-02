{{--
    Site header: skip link + banner landmark + primary navigation.

    The skip link lives here rather than in each view, so every page that
    includes the navbar gets a working "jump to content" affordance
    (WCAG 2.4.1). Its target is <main id="main-content"> in the views.
--}}
<a class="lc-skip-link" href="#main-content">Przejdź do treści głównej</a>

<header class="lc-header navbar navbar-expand-lg sticky-top" role="banner">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <b>language<span class="lc-brand-mark">Courses</span></b>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Rozwiń menu nawigacji">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="collapse navbar-collapse" id="navbarScroll" aria-label="Nawigacja główna">
            <ul class="navbar-nav me-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"
                       @if (request()->routeIs('home')) aria-current="page" @endif>Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}"
                       @if (request()->routeIs('courses.index')) aria-current="page" @endif>Kursy</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="coursesDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">Rodzaje</a>
                    <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                        @forelse ($navCourses as $course)
                            <li>
                                <a class="dropdown-item" href="{{ route('courses.show', ['id' => $course->id]) }}">{{ $course->name }}</a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted">Brak kursów</span></li>
                        @endforelse
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('regulamin') }}"
                       @if (request()->routeIs('regulamin')) aria-current="page" @endif>Regulamin</a>
                </li>
            </ul>

            @can('is-admin')
                <ul class="navbar-nav admin-nav ms-auto" aria-label="Nawigacja administratora">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.enrollment') }}"
                           @if (request()->routeIs('admin.enrollment')) aria-current="page" @endif>Zapisy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}"
                           @if (request()->routeIs('admin.users')) aria-current="page" @endif>Edycja użytkowników</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.courses') }}"
                           @if (request()->routeIs('admin.courses')) aria-current="page" @endif>Edycja kursów</a>
                    </li>
                </ul>
            @endcan
        </nav>

        {{-- Error pages remove this node by id, so the id must stay present. --}}
        <div class="dropdown" id="navbar-user">
            <a class="lc-user-menu dropdown-toggle" href="#" id="navbarDropdownMenuAvatar" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ url(Auth::user() ? Auth::user()->avatar : 'storage/img/user.png') }}"
                     class="rounded-circle" width="30" height="30"
                     alt="{{ Auth::check() ? 'Awatar użytkownika ' . Auth::user()->name : 'Awatar niezalogowanego użytkownika' }}"
                     loading="lazy">
                @if (Auth::check())
                    <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                @else
                    <span class="lc-visually-hidden">Menu konta</span>
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
                    <li><a class="dropdown-item" href="{{ route('register') }}">Zarejestruj się</a></li>
                @endif
            </ul>
        </div>
    </div>
</header>

@include('layouts.success-toast')
