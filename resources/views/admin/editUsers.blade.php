@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Użytkownicy - panel administratora | languageCourses',
    'metaDescription' => 'Panel administratora: lista i edycja kont użytkowników.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [
            ['label' => 'Panel administratora'],
            ['label' => 'Użytkownicy'],
        ]])

        <h1>Wszyscy klienci</h1>

        @include('layouts.session-error')
        @include('layouts.validation-error')

        @if ($users->isEmpty())
            <div class="lc-empty">
                <h2>Brak użytkowników</h2>
                <p>W systemie nie ma jeszcze żadnych kont klientów.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <caption>Konta użytkowników. Użyj przycisku „Edytuj”, aby rozwinąć formularz zmiany danych.</caption>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Awatar</th>
                            <th scope="col">Imię i nazwisko</th>
                            <th scope="col">Email</th>
                            <th scope="col">Data założenia konta</th>
                            <th scope="col">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php $created = \Carbon\Carbon::parse($user->created_at); @endphp
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    <img src="{{ asset($user->avatar ?: 'storage/img/user.png') }}"
                                         alt="Awatar użytkownika {{ $user->name }}"
                                         width="40" height="40" loading="lazy"
                                         style="border-radius: 50%; object-fit: cover;">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <time datetime="{{ $created->toDateString() }}">{{ $created->format('d.m.Y') }}</time>
                                </td>
                                <td>
                                    <div class="lc-row-actions">
                                        {{-- A real <button> rather than an <a href="#">: it toggles a
                                             panel, so it needs button semantics plus aria-expanded
                                             and aria-controls for screen reader users. --}}
                                        <button type="button" class="btn btn-info btn-sm"
                                                aria-expanded="false"
                                                aria-controls="edit-panel-{{ $user->id }}"
                                                onclick="toggleEditPanel('{{ $user->id }}', this)">
                                            Edytuj
                                            <span class="lc-visually-hidden">użytkownika {{ $user->name }}</span>
                                        </button>

                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                                                Usuń
                                                <span class="lc-visually-hidden">użytkownika {{ $user->name }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <tr id="edit-panel-{{ $user->id }}" hidden>
                                <td colspan="6">
                                    <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <fieldset>
                                            <legend>Edycja konta: {{ $user->name }}</legend>

                                            <div class="lc-field">
                                                <label for="name-{{ $user->id }}">Imię i nazwisko</label>
                                                <input type="text" class="form-control" id="name-{{ $user->id }}"
                                                       name="name" required value="{{ $user->name }}">
                                            </div>

                                            <div class="lc-field">
                                                <label for="email-{{ $user->id }}">Email</label>
                                                <input type="email" class="form-control" id="email-{{ $user->id }}"
                                                       name="email" required value="{{ $user->email }}">
                                            </div>

                                            <div class="form-check lc-field">
                                                <input class="form-check-input" type="checkbox"
                                                       id="admin-{{ $user->id }}" name="admin"
                                                       @checked($user->isAdmin())>
                                                <label class="form-check-label" for="admin-{{ $user->id }}">
                                                    Administrator
                                                </label>
                                            </div>

                                            <div class="lc-row-actions">
                                                <button type="submit" class="btn custom-btn">Zapisz</button>
                                                <button type="button" class="btn lc-btn-secondary"
                                                        onclick="toggleEditPanel('{{ $user->id }}')">Anuluj</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <nav aria-label="Paginacja listy użytkowników">
                    {{ $users->onEachSide(1)->withQueryString()->links('vendor.pagination.accessible') }}
                </nav>
            @endif
        @endif
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])

<script>
    function toggleEditPanel(userId, trigger) {
        var panel = document.getElementById('edit-panel-' + userId);
        if (!panel) {
            return;
        }

        // Using the [hidden] attribute keeps the row out of the accessibility
        // tree while collapsed, which display:none alone on a <tr> did not do
        // reliably across the previous inline-style toggling.
        var willOpen = panel.hidden;
        panel.hidden = !willOpen;

        var toggle = trigger || document.querySelector('[aria-controls="edit-panel-' + userId + '"]');
        if (toggle) {
            toggle.setAttribute('aria-expanded', String(willOpen));
        }

        if (willOpen) {
            var firstField = panel.querySelector('input, select, textarea');
            if (firstField) {
                firstField.focus();
            }
        } else if (toggle) {
            // Return focus to the control that opened the panel.
            toggle.focus();
        }
    }
</script>
</body>
</html>
