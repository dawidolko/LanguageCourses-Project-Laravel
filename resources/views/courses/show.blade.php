@include('layouts.html')

@php
    $courseUrl = route('courses.show', ['id' => $course->id]);

    $showJsonLd = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => $course->name,
            'description' => $course->description,
            'url' => $courseUrl,
            'image' => asset('storage/img/' . $course->path),
            'inLanguage' => $course->language,
            'teaches' => $course->language,
            'provider' => [
                '@type' => 'EducationalOrganization',
                'name' => 'languageCourses',
                'url' => route('home'),
            ],
            'hasCourseInstance' => [
                '@type' => 'CourseInstance',
                'courseMode' => 'online',
                'courseWorkload' => 'P6M',
                'instructor' => $teacher ? [
                    '@type' => 'Person',
                    'name' => $teacher->name,
                ] : null,
            ],
            'syllabusSections' => $lessons->values()->map(fn ($lesson, $i) => [
                '@type' => 'Syllabus',
                'position' => $i + 1,
                'name' => $lesson->title,
                'description' => $lesson->description,
            ])->all(),
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Strona główna', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Kursy', 'item' => route('courses.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $course->name, 'item' => $courseUrl],
            ],
        ],
    ];

    // Trim the description into a meta-length summary without cutting mid-word.
    $courseSummary = $course->description
        ? Str::limit(strip_tags($course->description), 155)
        : 'Kurs ' . $course->name . ' (' . $course->language . ') w languageCourses. Sprawdź plan lekcji, poznaj lektora i zapisz się online.';
@endphp

@include('layouts.head', [
    'pageTitle' => $course->name . ' - kurs ' . $course->language . ' | languageCourses',
    'metaDescription' => $courseSummary,
    'metaImage' => 'storage/img/' . $course->path,
    'jsonLd' => $showJsonLd,
])

<body>
    @include('layouts.navbar')

    <main id="main-content">
        <div class="lc-shell">
            @include('layouts.breadcrumbs', ['crumbs' => [
                ['label' => 'Kursy', 'url' => route('courses.index')],
                ['label' => $course->name],
            ]])

            @include('layouts.session-error')

            <div class="lc-course-layout">
                {{-- MAIN COLUMN --------------------------------------------- --}}
                <div>
                    <p class="lc-eyebrow">{{ $course->language }}</p>
                    <h1>{{ $course->name }}</h1>

                    <figure class="lc-course-figure">
                        <img src="{{ asset('storage/img/' . $course->path) }}"
                             alt="Materiały kursu {{ $course->name }}">
                    </figure>

                    <div class="lc-prose">
                        <h2>Opis kursu</h2>
                        <p>{{ $course->description }}</p>

                        <h2 id="plan-lekcji">Plan lekcji</h2>
                        @if ($lessons->isEmpty())
                            <div class="lc-empty">
                                <h3>Plan lekcji w przygotowaniu</h3>
                                <p>Szczegółowy program tego kursu pojawi się wkrótce. W razie pytań napisz do prowadzącego.</p>
                            </div>
                        @else
                            <p>Kurs obejmuje {{ $lessons->count() }} {{ $lessons->count() === 1 ? 'lekcję' : 'lekcji' }}.</p>
                            <ol class="lc-lesson-list">
                                @foreach ($lessons as $lesson)
                                    <li>
                                        <div>
                                            <strong>{{ $lesson->title }}</strong>
                                            @if ($lesson->description)
                                                <p>{{ $lesson->description }}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>

                {{-- SIDEBAR: enrolment + facts ------------------------------- --}}
                <div>
                    <div class="lc-sidecard">
                        <h2>Zapisz się na kurs</h2>

                        <dl class="lc-facts">
                            <div>
                                <dt>Język</dt>
                                <dd>{{ $course->language }}</dd>
                            </div>
                            <div>
                                <dt>Liczba lekcji</dt>
                                <dd>{{ $lessons->count() }}</dd>
                            </div>
                            <div>
                                <dt>Forma zajęć</dt>
                                <dd>Online</dd>
                            </div>
                            <div>
                                <dt>Czas dostępu</dt>
                                <dd>do 6 miesięcy</dd>
                            </div>
                        </dl>

                        @if (Auth::check())
                            <form action="{{ route('cart.add', ['course_id' => $course->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn custom-btn">
                                    Dodaj do koszyka
                                    <span class="lc-visually-hidden">kurs {{ $course->name }}</span>
                                </button>
                            </form>
                            <p class="lc-hint">Termin rozpoczęcia zajęć wybierzesz w koszyku.</p>
                        @else
                            <a href="{{ route('login') }}" class="btn custom-btn">
                                Zaloguj się, aby się zapisać
                                <span class="lc-visually-hidden">na kurs {{ $course->name }}</span>
                            </a>
                            <p class="lc-hint">
                                Nie masz jeszcze konta?
                                <a href="{{ route('register') }}">Zarejestruj się</a>.
                            </p>
                        @endif
                    </div>

                    @if ($teacher)
                        <div class="lc-sidecard mt-4">
                            <h2>Prowadzący</h2>
                            <div class="lc-teacher">
                                <div>
                                    <p class="lc-teacher-name">{{ $teacher->name }}</p>
                                    <p class="lc-meta-list mb-0">
                                        <a href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a><br>
                                        <a href="tel:{{ preg_replace('/\s+/', '', $teacher->phone) }}">{{ $teacher->phone }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
