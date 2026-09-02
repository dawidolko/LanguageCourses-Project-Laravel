@include('layouts.html')

@php
    // Structured data for the organisation and the site search box.
    $homeJsonLd = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => 'languageCourses',
            'description' => 'Szkoła językowa online oferująca kursy prowadzone przez doświadczonych lektorów.',
            'url' => route('home'),
            'logo' => asset('storage/img/logo.png'),
            'email' => 'languageCourses@contact.com',
            'sameAs' => [
                'https://facebook.com',
                'https://twitter.com',
                'https://instagram.com',
                'https://linkedin.com',
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'languageCourses',
            'url' => route('home'),
            'inLanguage' => 'pl-PL',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => route('courses.index') . '?name={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ],
    ];

    // FAQPage mirrors the <details> block further down the page. The questions
    // and answers must stay in sync with the visible copy.
    $homeJsonLd[] = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect([
            ['Jak zapisać się na kurs?', 'Załóż konto, otwórz stronę wybranego kursu i dodaj go do koszyka. W koszyku ustawiasz datę rozpoczęcia zajęć, a następnie potwierdzasz zapis.'],
            ['Czy mogę wybrać termin rozpoczęcia zajęć?', 'Tak. W koszyku każdy kurs ma własne pole daty. Możesz wskazać dowolny dzień od dzisiaj do sześciu miesięcy w przód.'],
            ['Jak długo mam dostęp do materiałów?', 'Maksymalny czas uczestnictwa w jednym kursie to sześć miesięcy, chyba że przy kursie zaznaczono inaczej.'],
            ['Czy mogę zrezygnować z kursu?', 'Tak, uczestnictwo możesz zakończyć w dowolnym momencie, informując o tym administrację serwisu.'],
        ])->map(fn ($qa) => [
            '@type' => 'Question',
            'name' => $qa[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $qa[1]],
        ])->all(),
    ];
@endphp

@include('layouts.head', [
    'pageTitle' => 'languageCourses - kursy językowe online z lektorem',
    'metaDescription' => 'Ucz się angielskiego, niemieckiego i innych języków online. Małe grupy, doświadczeni lektorzy, elastyczne terminy zajęć. Sprawdź ofertę kursów i zapisz się przez internet.',
    'jsonLd' => $homeJsonLd,
])

<body>
    @include('layouts.navbar')

    <main id="main-content">
        {{-- HERO ------------------------------------------------------------ --}}
        <section class="lc-hero">
            <div class="lc-shell">
                <div class="lc-hero-inner">
                    <div>
                        <p class="lc-eyebrow">Szkoła językowa online</p>
                        <h1>Naucz się języka, którego naprawdę użyjesz</h1>
                        <p class="lc-hero-lead">
                            Kursy prowadzone przez lektorów, którzy uczą na co dzień. Małe grupy,
                            konkretny plan lekcji i termin, który sam wybierasz przy zapisie.
                        </p>

                        <div class="lc-hero-actions">
                            <a href="{{ route('courses.index') }}" class="btn custom-btn">
                                Przeglądaj kursy
                            </a>
                            <a href="#oferta" class="btn lc-btn-secondary">
                                Zobacz ofertę
                            </a>
                        </div>

                        <dl class="lc-hero-stats">
                            <div>
                                <dd>{{ $courses->count() > 0 ? $courses->count() : '—' }}</dd>
                                <dt>kursów w ofercie</dt>
                            </div>
                            <div>
                                <dd>6</dd>
                                <dt>miesięcy dostępu</dt>
                            </div>
                            <div>
                                <dd>100%</dd>
                                <dt>zajęć z lektorem</dt>
                            </div>
                        </dl>
                    </div>

                    <div class="lc-hero-media">
                        {{-- Decorative: the surrounding copy already says what this is. --}}
                        <img src="{{ asset('img/carousel3.jpg') }}" alt="" width="800" height="600">
                    </div>
                </div>
            </div>
        </section>

        {{-- VALUE PROPS ----------------------------------------------------- --}}
        <section class="lc-section">
            <div class="lc-shell">
                <div class="lc-section-head">
                    <h2>Dlaczego languageCourses</h2>
                    <p>Trzy rzeczy, które odróżniają nasze zajęcia od kursu z aplikacji.</p>
                </div>

                <ul class="lc-feature-grid">
                    <li class="lc-feature">
                        <h3>Zajęcia z lektorem</h3>
                        <p>Każdy kurs prowadzi konkretna osoba, której dane kontaktowe znajdziesz na stronie kursu.</p>
                    </li>
                    <li class="lc-feature">
                        <h3>Ty wybierasz termin</h3>
                        <p>Datę rozpoczęcia ustalasz sam w koszyku, w oknie do sześciu miesięcy od zapisu.</p>
                    </li>
                    <li class="lc-feature">
                        <h3>Jasny plan lekcji</h3>
                        <p>Pełna lista lekcji wraz z opisami jest widoczna zanim zdecydujesz się na zapis.</p>
                    </li>
                </ul>
            </div>
        </section>

        {{-- COURSES --------------------------------------------------------- --}}
        <section class="lc-section" id="oferta">
            <div class="lc-shell">
                <div class="lc-section-head">
                    <h2>Zapisz się na kurs już dziś</h2>
                    <p>Wybrane kursy z naszej oferty. Pełną listę znajdziesz w zakładce Kursy.</p>
                </div>

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
                            <h3>Nie ma jeszcze żadnych kursów</h3>
                            <p>Pracujemy nad nową ofertą. Zajrzyj do nas ponownie za kilka dni.</p>
                            <a href="{{ route('courses.index') }}" class="btn lc-btn-secondary">Przejdź do listy kursów</a>
                        </div>
                    @endforelse
                </div>

                @if ($courses->isNotEmpty())
                    <p><a href="{{ route('courses.index') }}">Zobacz wszystkie kursy</a></p>
                @endif
            </div>
        </section>

        {{-- FAQ ------------------------------------------------------------- --}}
        <section class="lc-section">
            <div class="lc-shell">
                <div class="lc-section-head">
                    <h2>Najczęstsze pytania</h2>
                </div>

                <div class="lc-faq">
                    <details>
                        <summary>Jak zapisać się na kurs?</summary>
                        <div class="lc-faq-body">
                            <p>
                                Załóż konto, otwórz stronę wybranego kursu i dodaj go do koszyka.
                                W koszyku ustawiasz datę rozpoczęcia zajęć, a następnie potwierdzasz zapis.
                            </p>
                        </div>
                    </details>

                    <details>
                        <summary>Czy mogę wybrać termin rozpoczęcia zajęć?</summary>
                        <div class="lc-faq-body">
                            <p>
                                Tak. W koszyku każdy kurs ma własne pole daty. Możesz wskazać dowolny
                                dzień od dzisiaj do sześciu miesięcy w przód.
                            </p>
                        </div>
                    </details>

                    <details>
                        <summary>Jak długo mam dostęp do materiałów?</summary>
                        <div class="lc-faq-body">
                            <p>
                                Maksymalny czas uczestnictwa w jednym kursie to sześć miesięcy,
                                chyba że przy kursie zaznaczono inaczej. Szczegóły opisuje
                                <a href="{{ route('regulamin') }}">regulamin</a>.
                            </p>
                        </div>
                    </details>

                    <details>
                        <summary>Czy mogę zrezygnować z kursu?</summary>
                        <div class="lc-faq-body">
                            <p>
                                Tak, uczestnictwo możesz zakończyć w dowolnym momencie, informując o tym
                                administrację serwisu.
                            </p>
                        </div>
                    </details>
                </div>
            </div>
        </section>
    </main>

    @include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
