@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Rejestracja - languageCourses',
    'metaDescription' => 'Załóż darmowe konto w languageCourses i zapisz się na kurs językowy prowadzony przez doświadczonego lektora.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        <div class="lc-auth">
            <div class="lc-auth-card">
                <div class="lc-auth-head">
                    <img src="{{ asset('storage/img/logo.png') }}" alt="Logo languageCourses">
                    <h1>Zarejestruj się</h1>
                    <p>Załóż konto, aby zapisywać się na kursy i wybierać terminy zajęć.</p>
                </div>

                @include('layouts.session-error')
                @include('layouts.validation-error')

                <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                    @csrf

                    {{-- The controller validates the "name" field, so the error
                         binding here must use "name" as well. --}}
                    <div class="lc-field">
                        <label for="name">Imię i nazwisko</label>
                        <input id="name" name="name" type="text" autocomplete="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required
                               @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                        @error('name')
                            <span class="invalid-feedback" id="name-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lc-field">
                        <label for="email">Adres e-mail</label>
                        <input id="email" name="email" type="email" autocomplete="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required
                               @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        @error('email')
                            <span class="invalid-feedback" id="email-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lc-field">
                        <label for="password">Hasło</label>
                        <input id="password" name="password" type="password" autocomplete="new-password"
                               class="form-control @error('password') is-invalid @enderror" required
                               aria-describedby="password-hint @error('password') password-error @enderror">
                        {{-- Stating the rules up front (WCAG 3.3.2) rather than
                             only failing after submit. --}}
                        <span class="lc-hint" id="password-hint">
                            Minimum 8 znaków, w tym mała i wielka litera, cyfra oraz znak specjalny (@$!%*#?&).
                        </span>
                        @error('password')
                            <span class="invalid-feedback" id="password-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lc-field">
                        <label for="password_confirmation">Potwierdź hasło</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               autocomplete="new-password" class="form-control" required
                               aria-describedby="password-confirmation-hint">
                        <span class="lc-hint" id="password-confirmation-hint">Wpisz ponownie to samo hasło.</span>
                    </div>

                    <button class="btn custom-btn" type="submit">Zarejestruj się</button>
                </form>

                <p class="lc-auth-foot">
                    Masz już konto? <a href="{{ route('login') }}">Zaloguj się</a>
                </p>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])

<script>
    // Confirm the two password fields match before the round trip. The message
    // is rendered as text next to the field, not just as a red border.
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('registerForm');
        if (!form) {
            return;
        }

        var password = document.getElementById('password');
        var confirmation = document.getElementById('password_confirmation');
        var errorId = 'password-confirmation-error';

        form.addEventListener('submit', function (event) {
            var existing = document.getElementById(errorId);

            if (password.value !== confirmation.value) {
                event.preventDefault();

                if (!existing) {
                    existing = document.createElement('span');
                    existing.className = 'invalid-feedback';
                    existing.id = errorId;
                    confirmation.insertAdjacentElement('afterend', existing);
                }
                existing.textContent = 'Hasła nie są identyczne.';

                confirmation.classList.add('is-invalid');
                confirmation.setAttribute('aria-invalid', 'true');
                confirmation.setAttribute('aria-describedby', 'password-confirmation-hint ' + errorId);
                confirmation.focus();
            } else {
                confirmation.classList.remove('is-invalid');
                confirmation.removeAttribute('aria-invalid');
                confirmation.setAttribute('aria-describedby', 'password-confirmation-hint');
                if (existing) {
                    existing.remove();
                }
            }
        });
    });
</script>
</body>
</html>
