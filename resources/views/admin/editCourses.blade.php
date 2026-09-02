@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Kursy - panel administratora | languageCourses',
    'metaDescription' => 'Panel administratora: dodawanie i edycja kursów, lekcji oraz nauczycieli.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [
            ['label' => 'Panel administratora'],
            ['label' => 'Kursy'],
        ]])

        <h1>Wszystkie kursy</h1>

        @include('layouts.session-error')
        @include('layouts.validation-error')

        {{-- ADD PANELS ------------------------------------------------------
             Each panel had duplicated element ids in the previous version
             (three separate "name" / "description" inputs on one page), which
             broke every <label for>. Ids are now namespaced per panel. --}}
        <div class="lc-row-actions mb-4">
            <button type="button" class="btn custom-btn" aria-expanded="false"
                    aria-controls="add-panel-course" onclick="toggleAddPanel('course', this)">
                Dodaj kurs
            </button>
            <button type="button" class="btn lc-btn-secondary" aria-expanded="false"
                    aria-controls="add-panel-lesson" onclick="toggleAddPanel('lesson', this)">
                Dodaj lekcję
            </button>
            <button type="button" class="btn lc-btn-secondary" aria-expanded="false"
                    aria-controls="add-panel-teacher" onclick="toggleAddPanel('teacher', this)">
                Dodaj nauczyciela
            </button>
        </div>

        <section id="add-panel-course" class="lc-form-card mb-4" hidden>
            <form action="{{ route('admin.addCourse') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <legend>Nowy kurs</legend>

                    <div class="lc-field">
                        <label for="course-name">Nazwa kursu</label>
                        <input type="text" class="form-control" id="course-name" name="name" required>
                    </div>

                    <div class="lc-field">
                        <label for="course-description">Opis</label>
                        <textarea class="form-control" id="course-description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="lc-field">
                        <label for="course-language">Język</label>
                        <input type="text" class="form-control" id="course-language" name="language" required>
                    </div>

                    <div class="lc-field">
                        <label for="course-teacher">Nauczyciel</label>
                        <select class="form-select" id="course-teacher" name="teacher_id" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lc-field">
                        <label for="course-image">Zdjęcie</label>
                        <input type="file" class="form-control" id="course-image" name="image"
                               accept="image/*" required aria-describedby="course-image-hint">
                        <span class="lc-hint" id="course-image-hint">Obraz reprezentujący kurs na liście.</span>
                    </div>

                    <button type="submit" class="btn custom-btn">Dodaj kurs</button>
                </fieldset>
            </form>
        </section>

        <section id="add-panel-lesson" class="lc-form-card mb-4" hidden>
            <form action="{{ route('admin.addLesson') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Nowa lekcja</legend>

                    <div class="lc-field">
                        <label for="lesson-title">Tytuł lekcji</label>
                        <input type="text" class="form-control" id="lesson-title" name="title" required>
                    </div>

                    <div class="lc-field">
                        <label for="lesson-description">Opis</label>
                        <textarea class="form-control" id="lesson-description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="lc-field">
                        <label for="lesson-course">Kurs</label>
                        <select class="form-select" id="lesson-course" name="course_id" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn custom-btn">Dodaj lekcję</button>
                </fieldset>
            </form>
        </section>

        <section id="add-panel-teacher" class="lc-form-card mb-4" hidden>
            <form action="{{ route('admin.addTeacher') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Nowy nauczyciel</legend>

                    <div class="lc-field">
                        <label for="teacher-name">Imię i nazwisko nauczyciela</label>
                        <input type="text" class="form-control" id="teacher-name" name="name"
                               autocomplete="name" required>
                    </div>

                    <div class="lc-field">
                        <label for="teacher-email">Email</label>
                        <input type="email" class="form-control" id="teacher-email" name="email"
                               autocomplete="email" required>
                    </div>

                    <div class="lc-field">
                        <label for="teacher-phone">Telefon</label>
                        <input type="tel" class="form-control" id="teacher-phone" name="phone"
                               autocomplete="tel" required>
                    </div>

                    <button type="submit" class="btn custom-btn">Dodaj nauczyciela</button>
                </fieldset>
            </form>
        </section>

        {{-- COURSE TABLE ---------------------------------------------------- --}}
        @if ($courses->isEmpty())
            <div class="lc-empty">
                <h2>Brak kursów</h2>
                <p>Nie dodano jeszcze żadnego kursu. Użyj przycisku „Dodaj kurs” powyżej.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <caption>Wszystkie kursy w systemie. Użyj przycisku „Edytuj”, aby rozwinąć formularz.</caption>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Zdjęcie</th>
                            <th scope="col">Nazwa kursu</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Język</th>
                            <th scope="col">Nauczyciel</th>
                            <th scope="col">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <th scope="row">{{ $course->id }}</th>
                                <td>
                                    <img src="{{ asset('storage/img/' . $course->path) }}"
                                         alt="" width="80" height="60" loading="lazy"
                                         style="object-fit: cover;">
                                </td>
                                <td>{{ $course->name }}</td>
                                <td>{{ Str::limit($course->description, 120) }}</td>
                                <td>{{ $course->language }}</td>
                                <td>{{ $course->teacher->name ?? 'Brak danych' }}</td>
                                <td>
                                    <div class="lc-row-actions">
                                        <button type="button" class="btn btn-info btn-sm"
                                                aria-expanded="false"
                                                aria-controls="edit-panel-{{ $course->id }}"
                                                onclick="toggleEditPanel({{ $course->id }}, this)">
                                            Edytuj
                                            <span class="lc-visually-hidden">kurs {{ $course->name }}</span>
                                        </button>

                                        <form action="{{ route('admin.deleteCourse', ['id' => $course->id]) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Czy na pewno chcesz usunąć ten kurs?')">
                                                Usuń
                                                <span class="lc-visually-hidden">kurs {{ $course->name }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <tr id="edit-panel-{{ $course->id }}" hidden>
                                <td colspan="7">
                                    <form id="edit-form-{{ $course->id }}" method="POST"
                                          action="{{ route('admin.updateCourse', ['id' => $course->id]) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <fieldset>
                                            <legend>Edycja kursu: {{ $course->name }}</legend>

                                            <div class="lc-field">
                                                <label for="edit-name-{{ $course->id }}">Nazwa kursu</label>
                                                <input type="text" class="form-control"
                                                       id="edit-name-{{ $course->id }}" name="name"
                                                       value="{{ $course->name }}" required>
                                            </div>

                                            <div class="lc-field">
                                                <label for="edit-description-{{ $course->id }}">Opis</label>
                                                <textarea class="form-control" rows="4"
                                                          id="edit-description-{{ $course->id }}"
                                                          name="description" required>{{ $course->description }}</textarea>
                                            </div>

                                            <div class="lc-field">
                                                <label for="edit-language-{{ $course->id }}">Język</label>
                                                <input type="text" class="form-control"
                                                       id="edit-language-{{ $course->id }}" name="language"
                                                       value="{{ $course->language }}" required>
                                            </div>

                                            <div class="lc-field">
                                                <label for="edit-teacher-{{ $course->id }}">Nauczyciel</label>
                                                <select class="form-select" id="edit-teacher-{{ $course->id }}"
                                                        name="teacher_id" required>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}"
                                                            @selected($course->teacher_id == $teacher->id)>
                                                            {{ $teacher->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="lc-field">
                                                <label for="edit-image-{{ $course->id }}">Zdjęcie</label>
                                                <input type="file" accept="image/*"
                                                       class="form-control @error('image') is-invalid @enderror"
                                                       id="edit-image-{{ $course->id }}" name="image"
                                                       aria-describedby="edit-image-hint-{{ $course->id }}">
                                                <span class="lc-hint" id="edit-image-hint-{{ $course->id }}">
                                                    Zostaw puste, aby zachować obecne zdjęcie.
                                                </span>
                                                @error('image')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="lc-row-actions">
                                                <button type="submit" class="btn custom-btn">Zapisz</button>
                                                <button type="button" class="btn lc-btn-secondary"
                                                        onclick="toggleEditPanel({{ $course->id }})">Anuluj</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($courses->hasPages())
                <nav aria-label="Paginacja listy kursów">
                    {{ $courses->onEachSide(1)->withQueryString()->links('vendor.pagination.accessible') }}
                </nav>
            @endif
        @endif
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])

<script>
    // Generic disclosure toggle: flips [hidden], keeps aria-expanded in sync on
    // the triggering button and moves focus sensibly in both directions.
    function toggleDisclosure(panelId, trigger) {
        var panel = document.getElementById(panelId);
        if (!panel) {
            return;
        }

        var willOpen = panel.hidden;
        panel.hidden = !willOpen;

        var toggle = trigger || document.querySelector('[aria-controls="' + panelId + '"]');
        if (toggle) {
            toggle.setAttribute('aria-expanded', String(willOpen));
        }

        if (willOpen) {
            var firstField = panel.querySelector('input, select, textarea');
            if (firstField) {
                firstField.focus();
            }
        } else if (toggle) {
            toggle.focus();
        }
    }

    function toggleAddPanel(type, trigger) {
        toggleDisclosure('add-panel-' + type, trigger);
    }

    function toggleEditPanel(courseId, trigger) {
        toggleDisclosure('edit-panel-' + courseId, trigger);
    }
</script>
</body>
</html>
