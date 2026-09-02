@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Twój profil - languageCourses',
    'metaDescription' => 'Podgląd Twojego konta w languageCourses: dane, awatar i lista kursów, na które jesteś zapisany.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [['label' => 'Mój profil']]])

        {{-- One <h1> per page: the page title. The user's name is a heading
             inside the profile card, one level down. --}}
        <h1>Twój profil</h1>

        @include('layouts.session-error')
        @include('layouts.validation-error')

        @if (Auth::check())
            <section class="lc-profile-head" aria-labelledby="profile-identity">
                <img class="lc-avatar"
                     src="{{ url(Auth::user()->avatar ?: 'storage/img/user.png') }}"
                     alt="Awatar użytkownika {{ Auth::user()->name }}" loading="lazy">

                <div>
                    <h2 id="profile-identity">{{ Auth::user()->name }}</h2>
                    <ul class="lc-meta-list">
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        @if (Auth::user()->address)
                            <li><strong>Adres:</strong> {{ Auth::user()->address }}</li>
                        @endif
                    </ul>

                    <div class="lc-profile-actions">
                        <a href="{{ route('user.settings') }}" class="btn custom-btn">Edytuj dane</a>
                        <a href="{{ route('user.cart') }}" class="btn lc-btn-secondary">Koszyk</a>
                        <a href="{{ route('logout') }}" class="btn lc-btn-secondary">Wyloguj się</a>
                    </div>
                </div>
            </section>

            <section aria-labelledby="avatar-heading" class="lc-form-card mb-4">
                <h2 id="avatar-heading">Zmień awatar</h2>
                <form method="POST" action="{{ route('user.update_avatar') }}"
                      enctype="multipart/form-data" id="avatarForm" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="lc-field">
                        <label for="avatar">Plik obrazu</label>
                        <input id="avatar" name="avatar" type="file" accept="image/*"
                               class="form-control @error('avatar') is-invalid @enderror" required
                               aria-describedby="avatar-hint @error('avatar') avatar-error @enderror">
                        <span class="lc-hint" id="avatar-hint">Obraz w formacie JPG, PNG lub WEBP.</span>
                        @error('avatar')
                            <span class="invalid-feedback" id="avatar-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn custom-btn">Zaktualizuj awatar</button>
                </form>
            </section>

            <section aria-labelledby="enrollments-heading">
                <h2 id="enrollments-heading">Zapisane kursy</h2>

                @if ($enrollments->isEmpty())
                    <div class="lc-empty">
                        <h3>Nie masz jeszcze żadnych kursów</h3>
                        <p>Kiedy zapiszesz się na kurs, pojawi się on na tej liście wraz z terminem zajęć.</p>
                        <a href="{{ route('courses.index') }}" class="btn custom-btn">Przeglądaj kursy</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption>Kursy, na które jesteś zapisany, wraz z datą zajęć i statusem zapisu.</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Zdjęcie</th>
                                    <th scope="col">Nazwa kursu</th>
                                    <th scope="col">Nauczyciel</th>
                                    <th scope="col">Data zajęć</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enrollment)
                                    @php
                                        // An enrolment always has at least one lesson, but guard
                                        // anyway so a data gap cannot 500 the profile page.
                                        $course = optional($enrollment->lessons->first())->course;
                                        $lessonDate = $enrollment->lesson_date
                                            ? \Carbon\Carbon::parse($enrollment->lesson_date)
                                            : null;
                                    @endphp
                                    <tr>
                                        <td>
                                            @if ($course)
                                                <img src="{{ asset('storage/img/' . $course->path) }}"
                                                     alt="" width="72" height="54" loading="lazy"
                                                     style="object-fit: cover;">
                                            @endif
                                        </td>
                                        <th scope="row">{{ $course->name ?? 'Kurs niedostępny' }}</th>
                                        <td>{{ $course->teacher->name ?? 'Brak danych' }}</td>
                                        <td>
                                            @if ($lessonDate)
                                                <time datetime="{{ $lessonDate->toDateString() }}">
                                                    {{ $lessonDate->format('d.m.Y') }}
                                                </time>
                                            @else
                                                Brak terminu
                                            @endif
                                        </td>
                                        <td><span class="lc-status">{{ ucfirst($enrollment->status) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        @else
            <div class="lc-empty">
                <h2>Nie jesteś zalogowany</h2>
                <p>Zaloguj się, aby uzyskać dostęp do swojego profilu i zapisanych kursów.</p>
                <a href="{{ route('login') }}" class="btn custom-btn">Zaloguj się</a>
            </div>
        @endif
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])

<script>
    // Require a file before submitting the avatar form, reporting it as text.
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('avatarForm');
        if (!form) {
            return;
        }

        var fileInput = document.getElementById('avatar');
        var errorId = 'avatar-client-error';

        form.addEventListener('submit', function (event) {
            var existing = document.getElementById(errorId);

            if (fileInput.files.length === 0) {
                event.preventDefault();

                if (!existing) {
                    existing = document.createElement('span');
                    existing.className = 'invalid-feedback';
                    existing.id = errorId;
                    fileInput.insertAdjacentElement('afterend', existing);
                }
                existing.textContent = 'Wybierz plik obrazu, aby zaktualizować awatar.';

                fileInput.classList.add('is-invalid');
                fileInput.setAttribute('aria-invalid', 'true');
                fileInput.setAttribute('aria-describedby', 'avatar-hint ' + errorId);
                fileInput.focus();
            } else {
                fileInput.classList.remove('is-invalid');
                fileInput.removeAttribute('aria-invalid');
                fileInput.setAttribute('aria-describedby', 'avatar-hint');
                if (existing) {
                    existing.remove();
                }
            }
        });
    });
</script>
</body>
</html>
