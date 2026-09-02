@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Twój koszyk - languageCourses',
    'metaDescription' => 'Przejrzyj kursy dodane do koszyka, ustal termin rozpoczęcia zajęć i potwierdź zapis.',
    'robots' => 'noindex, nofollow',
])

<body>
    @include('layouts.navbar')

    <main id="main-content">
        <div class="lc-shell">
            @include('layouts.breadcrumbs', ['crumbs' => [['label' => 'Koszyk']]])

            <h1>Twój koszyk</h1>

            @include('layouts.session-error')
            @include('layouts.validation-error')

            @if (empty($cartItems))
                <div class="lc-empty">
                    <h2>Twój koszyk jest pusty</h2>
                    <p>Nie dodałeś jeszcze żadnego kursu. Przejrzyj ofertę i wybierz coś dla siebie.</p>
                    <a href="{{ route('courses.index') }}" class="btn custom-btn">Przeglądaj kursy</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <caption>
                            Kursy w koszyku ({{ count($cartItems) }}).
                            Aby dokończyć zapis, ustaw datę rozpoczęcia dla każdego kursu.
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col">Zdjęcie</th>
                                <th scope="col">Nazwa kursu</th>
                                <th scope="col">Opis</th>
                                <th scope="col">Nauczyciel</th>
                                <th scope="col">Data rozpoczęcia</th>
                                <th scope="col">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $courseId => $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/img/' . $item['course']->path) }}"
                                             alt="" width="80" height="60" loading="lazy"
                                             style="object-fit: cover;">
                                    </td>
                                    {{-- Row header: names the row for screen readers reading cells. --}}
                                    <th scope="row">{{ $item['course']->name }}</th>
                                    <td>{{ Str::limit($item['course']->description, 120) }}</td>
                                    <td>{{ $item['course']->teacher->name ?? 'Brak danych' }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', ['course_id' => $courseId]) }}"
                                              method="POST" class="update-date-form">
                                            @csrf
                                            <div class="lc-field">
                                                <label for="date-{{ $courseId }}">
                                                    Data rozpoczęcia
                                                    <span class="lc-visually-hidden">kursu {{ $item['course']->name }}</span>
                                                </label>
                                                <input type="date" id="date-{{ $courseId }}" name="selected_date"
                                                       class="form-control date-input"
                                                       value="{{ $item['selected_date'] }}"
                                                       aria-describedby="date-hint-{{ $courseId }}">
                                                <span class="lc-hint" id="date-hint-{{ $courseId }}">
                                                    Do 6 miesięcy od dziś.
                                                </span>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-sm">
                                                Aktualizuj datę
                                                <span class="lc-visually-hidden">kursu {{ $item['course']->name }}</span>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', ['course_id' => $courseId]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Usuń
                                                <span class="lc-visually-hidden">kurs {{ $item['course']->name }} z koszyka</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    {{-- The reason the button is disabled is stated in text, and
                         the live region announces the change (WCAG 3.3.1). --}}
                    <p id="checkout-status" class="lc-hint" role="status">
                        Ustaw datę rozpoczęcia dla każdego kursu, aby aktywować zapis.
                    </p>
                    <button type="submit" class="btn custom-btn disabled-btn" id="checkout-button"
                            disabled aria-describedby="checkout-status">
                        Zapisz się na kurs
                    </button>
                </form>
            @endif
        </div>
    </main>

    @include('layouts.footer', ['fixedBottom' => false])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dateInputs = document.querySelectorAll('.date-input');
            var updateForms = document.querySelectorAll('.update-date-form');
            var checkoutButton = document.getElementById('checkout-button');
            var checkoutStatus = document.getElementById('checkout-status');

            if (!checkoutButton || dateInputs.length === 0) {
                return;
            }

            var today = new Date();
            var maxDate = new Date();
            maxDate.setMonth(today.getMonth() + 6);

            function formatDateString(date) {
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var day = String(date.getDate()).padStart(2, '0');
                return date.getFullYear() + '-' + month + '-' + day;
            }

            var minDateString = formatDateString(today);
            var maxDateString = formatDateString(maxDate);

            dateInputs.forEach(function (input) {
                input.setAttribute('min', minDateString);
                input.setAttribute('max', maxDateString);
            });

            function updateCheckoutButtonState() {
                var allDatesSet = Array.prototype.every.call(dateInputs, function (input) {
                    return Boolean(input.value);
                });

                checkoutButton.disabled = !allDatesSet;
                checkoutButton.classList.toggle('disabled-btn', !allDatesSet);
                checkoutStatus.textContent = allDatesSet
                    ? 'Wszystkie terminy ustawione. Możesz potwierdzić zapis.'
                    : 'Ustaw datę rozpoczęcia dla każdego kursu, aby aktywować zapis.';
            }

            updateForms.forEach(function (form) {
                form.addEventListener('submit', function () {
                    setTimeout(updateCheckoutButtonState, 100);
                });
            });

            // React as the user types rather than only on submit.
            dateInputs.forEach(function (input) {
                input.addEventListener('change', updateCheckoutButtonState);
            });

            updateCheckoutButtonState();
        });
    </script>
</body>
</html>
