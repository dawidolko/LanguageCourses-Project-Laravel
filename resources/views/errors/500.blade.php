@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => '500 - Błąd wewnętrzny serwera | languageCourses',
    'metaDescription' => 'Coś poszło nie tak po naszej stronie. Spróbuj ponownie za chwilę, a jeśli problem się powtarza, skontaktuj się z pomocą techniczną.',
    // Error pages must never be indexed.
    'robots' => 'noindex, follow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        <div class="lc-error">
            <div class="lc-error-inner">
                {{-- The numeric code is decorative next to the heading text,
                     so it is not announced twice. --}}
                <p class="lc-error-code" aria-hidden="true">500</p>

                <h1>Błąd wewnętrzny serwera</h1>

                <p>Coś poszło nie tak po naszej stronie. Spróbuj ponownie za chwilę, a jeśli problem się powtarza, skontaktuj się z pomocą techniczną.</p>

                <div class="lc-error-actions">
                    <a href="{{ url('/') }}" class="btn custom-btn">Wróć na stronę główną</a>
                    <a href="{{ route('courses.index') }}" class="btn lc-btn-secondary">Przeglądaj kursy</a>
                </div>

                {{-- In local development show the underlying message, which is
                     useful while debugging but must never leak in production. --}}
                @if (App::environment('local') && isset($exception) && $exception->getMessage())
                    <details class="lc-error-detail">
                        <summary>Szczegóły techniczne (tylko środowisko lokalne)</summary>
                        <pre>{{ $exception->getMessage() }}</pre>
                    </details>
                @endif
            </div>
        </div>
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
