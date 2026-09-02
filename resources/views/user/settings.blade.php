@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Ustawienia konta - languageCourses',
    'metaDescription' => 'Zmień imię i nazwisko, awatar oraz hasło do swojego konta w languageCourses.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [
            ['label' => 'Mój profil', 'url' => route('user.profile')],
            ['label' => 'Ustawienia'],
        ]])

        <h1>Ustawienia konta</h1>

        @if (Auth::check())
            @include('layouts.session-error')
            @include('layouts.validation-error')

            <div class="lc-stack" style="max-width: 40rem;">
                {{-- NAME ---------------------------------------------------- --}}
                <section class="lc-form-card" aria-labelledby="name-heading">
                    <h2 id="name-heading">Dane osobowe</h2>

                    <form method="POST" action="{{ route('user.update_name') }}" id="nameForm" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="lc-field">
                            <label for="name">Imię i nazwisko</label>
                            <input id="name" name="name" type="text" autocomplete="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', Auth::user()->name) }}" required
                                   aria-describedby="name-hint @error('name') name-error @enderror">
                            <span class="lc-hint" id="name-hint">Tylko litery i spacje.</span>
                            @error('name')
                                <span class="invalid-feedback" id="name-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn custom-btn">Zapisz zmiany</button>
                    </form>
                </section>

                {{-- AVATAR -------------------------------------------------- --}}
                <section class="lc-form-card" aria-labelledby="avatar-heading">
                    <h2 id="avatar-heading">Awatar</h2>

                    <form method="POST" action="{{ route('user.update_avatar') }}"
                          enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="lc-field">
                            <label for="avatar">Nowy awatar</label>
                            <input id="avatar" name="avatar" type="file" accept="image/*"
                                   class="form-control @error('avatar') is-invalid @enderror" required
                                   aria-describedby="avatar-hint @error('avatar') avatar-error @enderror">
                            <span class="lc-hint" id="avatar-hint">
                                Formaty: jpeg, png, jpg, gif, svg. Maksymalny rozmiar 2048 kB.
                            </span>
                            @error('avatar')
                                <span class="invalid-feedback" id="avatar-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn custom-btn">Zaktualizuj awatar</button>
                    </form>
                </section>

                {{-- PASSWORD ------------------------------------------------ --}}
                <section class="lc-form-card" aria-labelledby="password-heading">
                    <h2 id="password-heading">Zmiana hasła</h2>

                    <form method="POST" action="{{ route('user.change_password') }}" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="lc-field">
                            <label for="current_password">Obecne hasło</label>
                            <input id="current_password" name="current_password" type="password"
                                   autocomplete="current-password"
                                   class="form-control @error('current_password') is-invalid @enderror" required
                                   @error('current_password') aria-invalid="true" aria-describedby="current-password-error" @enderror>
                            @error('current_password')
                                <span class="invalid-feedback" id="current-password-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="lc-field">
                            <label for="new_password">Nowe hasło</label>
                            <input id="new_password" name="new_password" type="password"
                                   autocomplete="new-password"
                                   class="form-control @error('new_password') is-invalid @enderror" required
                                   aria-describedby="new-password-hint @error('new_password') new-password-error @enderror">
                            <span class="lc-hint" id="new-password-hint">
                                Minimum 8 znaków, w tym mała i wielka litera, cyfra oraz znak specjalny (@$!%*?&).
                            </span>
                            @error('new_password')
                                <span class="invalid-feedback" id="new-password-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="lc-field">
                            <label for="new_password_confirmation">Potwierdzenie nowego hasła</label>
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                                   autocomplete="new-password" class="form-control" required
                                   aria-describedby="new-password-confirmation-hint">
                            <span class="lc-hint" id="new-password-confirmation-hint">
                                Wpisz ponownie nowe hasło.
                            </span>
                        </div>

                        <button type="submit" class="btn custom-btn">Zmień hasło</button>
                    </form>
                </section>
            </div>
        @else
            <div class="lc-empty">
                <h2>Nie jesteś zalogowany</h2>
                <p>Zaloguj się, aby uzyskać dostęp do ustawień konta.</p>
                <a href="{{ route('login') }}" class="btn custom-btn">Zaloguj się</a>
            </div>
        @endif
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])

<script>
    // Mirror the server's "letters and spaces only" rule inline, so the user is
    // told next to the field rather than through a blocking alert() dialog.
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('nameForm');
        if (!form) {
            return;
        }

        var name = document.getElementById('name');
        var errorId = 'name-client-error';

        form.addEventListener('submit', function (event) {
            var existing = document.getElementById(errorId);

            if (!/^[\p{L}\s]+$/u.test(name.value.trim())) {
                event.preventDefault();

                if (!existing) {
                    existing = document.createElement('span');
                    existing.className = 'invalid-feedback';
                    existing.id = errorId;
                    name.insertAdjacentElement('afterend', existing);
                }
                existing.textContent = 'Imię i nazwisko może zawierać tylko litery i spacje.';

                name.classList.add('is-invalid');
                name.setAttribute('aria-invalid', 'true');
                name.setAttribute('aria-describedby', 'name-hint ' + errorId);
                name.focus();
            } else {
                name.classList.remove('is-invalid');
                name.removeAttribute('aria-invalid');
                name.setAttribute('aria-describedby', 'name-hint');
                if (existing) {
                    existing.remove();
                }
            }
        });
    });
</script>
</body>
</html>
