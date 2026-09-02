@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => '400 - Nieprawidłowe żądanie | languageCourses',
    'metaDescription' => 'Serwer nie zrozumiał tego żądania. Sprawdź adres i spróbuj ponownie.',
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
                <p class="lc-error-code" aria-hidden="true">400</p>

                <h1>Nieprawidłowe żądanie</h1>

                <p>Serwer nie zrozumiał tego żądania. Sprawdź adres i spróbuj ponownie.</p>

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
