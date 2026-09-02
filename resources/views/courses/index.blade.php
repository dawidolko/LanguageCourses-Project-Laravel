@include('layouts.html')

@php
    $hasFilters = request()->filled('name') || request()->filled('language');

    $indexJsonLd = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Strona główna', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Kursy', 'item' => route('courses.index')],
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => 'Kursy językowe',
            'numberOfItems' => $courses->total(),
            'itemListElement' => $courses->values()->map(fn ($course, $i) => [
                '@type' => 'ListItem',
                'position' => $courses->firstItem() + $i,
                'url' => route('courses.show', ['id' => $course->id]),
                'name' => $course->name,
            ])->all(),
        ],
    ];
@endphp

@include('layouts.head', [
    'pageTitle' => 'Kursy językowe - languageCourses',
    'metaDescription' => 'Pełna lista kursów językowych w languageCourses. Filtruj po nazwie i języku, sprawdź plan lekcji i lektora, a następnie zapisz się online.',
    'jsonLd' => $indexJsonLd,
    // Filtered result pages are near-duplicates of the base listing, so keep
    // the canonical pointed at the unfiltered URL.
    'canonical' => $hasFilters ? route('courses.index') : url()->current(),
    'robots' => $hasFilters ? 'noindex, follow' : 'index, follow',
])

<body>
    @include('layouts.navbar')

    <main id="main-content">
        <div class="lc-shell">
            @include('layouts.breadcrumbs', ['crumbs' => [['label' => 'Kursy']]])

            <div class="lc-section-head">
                <p class="lc-eyebrow">Oferta</p>
                <h1>Kursy językowe</h1>
                <p class="lc-courses-intro">
                    Wybierz język i poziom, sprawdź plan lekcji oraz prowadzącego,
                    a termin rozpoczęcia ustalisz sam podczas zapisu.
                </p>
            </div>

            {{-- FILTERS ----------------------------------------------------- --}}
            <section class="lc-filter" aria-labelledby="filter-heading">
                <h2 id="filter-heading" class="lc-visually-hidden">Filtrowanie kursów</h2>

                <form action="{{ route('courses.index') }}" method="GET">
                    <div class="lc-filter-grid">
                        <div class="lc-field">
                            <label for="name">Nazwa kursu</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ request('name') }}"
                                   aria-describedby="name-hint"
                                   placeholder="np. angielski dla początkujących">
                            <span class="lc-hint" id="name-hint">Wpisz fragment nazwy, aby zawęzić wyniki.</span>
                        </div>

                        <div class="lc-field">
                            <label for="language">Język</label>
                            <select name="language" id="language" class="form-select">
                                <option value="">Wszystkie języki</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->language }}"
                                        @selected(request('language') === $language->language)>
                                        {{ $language->language }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="lc-field">
                            <button type="submit" class="btn custom-btn">Filtruj</button>
                        </div>
                    </div>

                    @if ($hasFilters)
                        <p class="mt-3 mb-0">
                            <a href="{{ route('courses.index') }}">Wyczyść filtry</a>
                        </p>
                    @endif
                </form>
            </section>

            {{-- RESULTS ----------------------------------------------------- --}}
            <section aria-labelledby="results-heading">
                <h2 id="results-heading" class="lc-visually-hidden">Wyniki wyszukiwania</h2>

                {{-- Announced politely so filtering feedback reaches screen readers. --}}
                <p class="lc-result-count" role="status">
                    @if ($courses->total() === 1)
                        Znaleziono 1 kurs.
                    @else
                        Znaleziono {{ $courses->total() }} kursów.
                    @endif
                </p>

                <div class="product-grid">
                    @forelse ($courses as $course)
                        <article class="showcase">
                            <div class="showcase-banner">
                                <img src="{{ asset('storage/img/' . $course->path) }}"
                                     alt="" class="product-img hover" loading="lazy">
                                <img src="{{ asset('storage/img/' . $course->path) }}"
                                     alt="Materiały kursu {{ $course->name }}" class="product-img default" loading="lazy">
                            </div>

                            <div class="showcase-content">
                                <span class="showcase-category">{{ $course->language }}</span>

                                <a href="{{ route('courses.show', ['id' => $course->id]) }}">
                                    <h3 class="showcase-title">{{ $course->name }}</h3>
                                </a>

                                @if ($course->description)
                                    <p class="lc-card-excerpt">{{ $course->description }}</p>
                                @endif

                                @if ($course->teacher)
                                    <p class="lc-card-meta">
                                        <span>
                                            <i class="bi bi-person-fill" aria-hidden="true"></i>
                                            Prowadzi: {{ $course->teacher->name }}
                                        </span>
                                    </p>
                                @endif

                                <div class="card-body">
                                    <a href="{{ route('courses.show', ['id' => $course->id]) }}" class="btn custom-btn">
                                        Przejdź do kursu
                                        <span class="lc-visually-hidden">{{ $course->name }}</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="lc-empty">
                            <h3>Brak kursów spełniających kryteria</h3>
                            @if ($hasFilters)
                                <p>Nie znaleźliśmy kursów dla wybranych filtrów. Spróbuj wpisać inną nazwę lub wybrać inny język.</p>
                                <a href="{{ route('courses.index') }}" class="btn custom-btn">Pokaż wszystkie kursy</a>
                            @else
                                <p>W tej chwili nie ma żadnych dostępnych kursów. Zajrzyj do nas ponownie za kilka dni.</p>
                                <a href="{{ route('home') }}" class="btn lc-btn-secondary">Wróć na stronę główną</a>
                            @endif
                        </div>
                    @endforelse
                </div>

                @if ($courses->hasPages())
                    <nav aria-label="Paginacja listy kursów">
                        {{ $courses->onEachSide(1)->withQueryString()->links('vendor.pagination.accessible') }}
                    </nav>
                @endif
            </section>
        </div>
    </main>

    @include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
