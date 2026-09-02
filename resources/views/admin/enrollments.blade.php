@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Zapisy - panel administratora | languageCourses',
    'metaDescription' => 'Panel administratora: lista zapisów na kursy.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [['label' => 'Panel administratora'], ['label' => 'Zapisy']]])

        <h1>Zapisy na kursy</h1>

        @include('layouts.session-error')
        @include('layouts.validation-error')

        @if ($enrollments->isEmpty())
            <div class="lc-empty">
                <h2>Brak zapisów</h2>
                <p>Nikt nie zapisał się jeszcze na żaden kurs.</p>
                <a href="{{ route('admin.courses') }}" class="btn custom-btn">Przejdź do kursów</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <caption>Wszystkie zapisy na kursy wraz z datą zajęć i statusem.</caption>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Użytkownik</th>
                            <th scope="col">Kurs</th>
                            <th scope="col">Data lekcji</th>
                            <th scope="col">Status</th>
                            <th scope="col">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                            @php
                                $course = optional($enrollment->lessons->first())->course;
                                $lessonDate = $enrollment->lesson_date
                                    ? \Carbon\Carbon::parse($enrollment->lesson_date)
                                    : null;
                            @endphp
                            <tr>
                                <th scope="row">{{ $enrollment->id }}</th>
                                <td>{{ $enrollment->user->name ?? 'Brak danych' }}</td>
                                <td>{{ $course->name ?? 'Kurs niedostępny' }}</td>
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
                                <td>
                                    <div class="lc-row-actions">
                                        <a href="{{ route('admin.enrollments.edit', $enrollment->id) }}"
                                           class="btn btn-info btn-sm">
                                            Edytuj
                                            <span class="lc-visually-hidden">zapis numer {{ $enrollment->id }}</span>
                                        </a>
                                        <form action="{{ route('admin.enrollments.delete', $enrollment->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Czy na pewno chcesz usunąć ten zapis?')">
                                                Usuń
                                                <span class="lc-visually-hidden">zapis numer {{ $enrollment->id }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($enrollments->hasPages())
                <nav aria-label="Paginacja listy zapisów">
                    {{ $enrollments->onEachSide(1)->withQueryString()->links('vendor.pagination.accessible') }}
                </nav>
            @endif
        @endif
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
