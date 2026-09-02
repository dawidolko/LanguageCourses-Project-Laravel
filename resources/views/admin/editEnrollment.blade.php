@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Edycja zapisu #' . $enrollment->id . ' - panel administratora | languageCourses',
    'metaDescription' => 'Panel administratora: edycja statusu zapisu na kurs.',
    'robots' => 'noindex, nofollow',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [
            ['label' => 'Panel administratora'],
            ['label' => 'Zapisy', 'url' => route('admin.enrollment')],
            ['label' => 'Zapis #' . $enrollment->id],
        ]])

        <h1>Edytuj zapis #{{ $enrollment->id }}</h1>

        @include('layouts.session-error')
        @include('layouts.validation-error')

        <div class="lc-form-card" style="max-width: 34rem;">
            <form action="{{ route('admin.enrollments.update', $enrollment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="lc-field">
                    <label for="status">Status zapisu</label>
                    <select name="status" id="status"
                            class="form-select @error('status') is-invalid @enderror"
                            aria-describedby="status-hint @error('status') status-error @enderror">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected($enrollment->status === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <span class="lc-hint" id="status-hint">Zmiana statusu jest widoczna w profilu użytkownika.</span>
                    @error('status')
                        <span class="invalid-feedback" id="status-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lc-row-actions">
                    <button type="submit" class="btn custom-btn">Zaktualizuj</button>
                    <a href="{{ route('admin.enrollment') }}" class="btn lc-btn-secondary">Anuluj</a>
                </div>
            </form>
        </div>
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
