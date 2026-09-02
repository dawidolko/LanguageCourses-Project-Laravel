@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Logowanie - languageCourses',
    'metaDescription' => 'Zaloguj się do languageCourses, aby zarządzać swoimi kursami, koszykiem i terminami zajęć.',
    // Account pages carry no value in the index.
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
                    <h1>Zaloguj się</h1>
                    <p>Wpisz dane swojego konta, aby kontynuować.</p>
                </div>

                @include('layouts.session-error')
                @include('layouts.validation-error')

                <form method="POST" action="{{ route('login.authenticate') }}" id="loginForm" novalidate>
                    @csrf

                    <div class="lc-field">
                        <label for="email">Adres e-mail</label>
                        <input id="email" name="email" type="email" autocomplete="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus
                               @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        @error('email')
                            <span class="invalid-feedback" id="email-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lc-field">
                        <label for="password">Hasło</label>
                        <input id="password" name="password" type="password" autocomplete="current-password"
                               class="form-control @error('password') is-invalid @enderror" required
                               @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                        @error('password')
                            <span class="invalid-feedback" id="password-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check lc-field">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1"
                               @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
                    </div>

                    <button class="btn custom-btn" type="submit">Zaloguj się</button>
                </form>

                <p class="lc-auth-foot">
                    Nie masz konta? <a href="{{ route('register') }}">Zarejestruj się</a>
                </p>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])

<script>
    // Client-side pre-check. Server-side validation remains authoritative; this
    // only saves a round trip and reports problems through the same aria-invalid
    // / aria-describedby wiring the server-rendered errors use.
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('loginForm');
        if (!form) {
            return;
        }

        var email = document.getElementById('email');
        var password = document.getElementById('password');

        function setError(field, message) {
            var errorId = field.id + '-client-error';
            var existing = document.getElementById(errorId);

            if (message) {
                field.classList.add('is-invalid');
                field.setAttribute('aria-invalid', 'true');
                if (!existing) {
                    existing = document.createElement('span');
                    existing.className = 'invalid-feedback';
                    existing.id = errorId;
                    field.insertAdjacentElement('afterend', existing);
                }
                existing.textContent = message;
                field.setAttribute('aria-describedby', errorId);
            } else {
                field.classList.remove('is-invalid');
                field.removeAttribute('aria-invalid');
                if (existing) {
                    existing.remove();
                    field.removeAttribute('aria-describedby');
                }
            }
        }

        form.addEventListener('submit', function (event) {
            var firstInvalid = null;

            if (!email.value.includes('@') || !email.value.includes('.')) {
                setError(email, 'Podaj poprawny adres e-mail.');
                firstInvalid = firstInvalid || email;
            } else {
                setError(email, null);
            }

            if (password.value.length < 8) {
                setError(password, 'Hasło musi mieć co najmniej 8 znaków.');
                firstInvalid = firstInvalid || password;
            } else {
                setError(password, null);
            }

            if (firstInvalid) {
                event.preventDefault();
                // Move focus to the first problem so the error is announced.
                firstInvalid.focus();
            }
        });
    });
</script>
</body>
</html>
