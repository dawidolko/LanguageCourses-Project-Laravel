@include('layouts.html')

@include('layouts.head', [
    'pageTitle' => 'Regulamin serwisu - languageCourses',
    'metaDescription' => 'Regulamin languageCourses: zasady rejestracji, zapisu na kursy, dostępu do materiałów oraz zakończenia uczestnictwa w zajęciach.',
])

<body>
@include('layouts.navbar')

<main id="main-content">
    <div class="lc-shell">
        @include('layouts.breadcrumbs', ['crumbs' => [['label' => 'Regulamin']]])

        <div class="lc-section-head">
            <p class="lc-eyebrow">Dokumenty</p>
            <h1>Regulamin serwisu</h1>
            <p>
                Zasady korzystania z serwisu languageCourses.
                Ostatnia aktualizacja: <time datetime="2024-01-01">1 stycznia 2024</time>.
            </p>
        </div>

        {{-- Table of contents: lets keyboard and screen reader users jump
             straight to a clause instead of walking the whole document. --}}
        <nav class="lc-form-card mb-5" aria-labelledby="toc-heading">
            <h2 id="toc-heading">Spis treści</h2>
            <ol class="lc-meta-list">
                <li><a href="#rozdzial-1">1. Rejestracja</a></li>
                <li><a href="#rozdzial-2">2. Wybór kursów</a></li>
                <li><a href="#rozdzial-3">3. Zapis na kurs i uczestnictwo</a></li>
                <li><a href="#rozdzial-4">4. Dostęp do materiałów</a></li>
                <li><a href="#rozdzial-5">5. Kary za naruszenie regulaminu</a></li>
                <li><a href="#rozdzial-6">6. Odpowiedzialność za utratę dostępu lub uszkodzenie treści cyfrowych</a></li>
                <li><a href="#rozdzial-7">7. Zakończenie uczestnictwa</a></li>
                <li><a href="#rozdzial-8">8. Zmiany w regulaminie</a></li>
                <li><a href="#rozdzial-9">9. Postanowienia końcowe</a></li>
            </ol>
        </nav>

        <div class="lc-prose lc-stack">
            <section aria-labelledby="rozdzial-1">
                <h2 id="rozdzial-1">1. Rejestracja</h2>
                <ul>
                    <li>Każdy użytkownik pragnący korzystać z usług languageCourses musi zarejestrować się, podając swoje rzeczywiste dane osobowe, w tym imię, nazwisko oraz adres e-mail.</li>
                    <li>Użytkownik zobowiązany jest do aktualizacji swoich danych osobowych w serwisie w przypadku ich zmiany.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-2">
                <h2 id="rozdzial-2">2. Wybór kursów</h2>
                <ul>
                    <li>Użytkownicy mają dostęp do szerokiej oferty darmowych kursów językowych dostępnych na platformie languageCourses.</li>
                    <li>Kursy mogą być dodawane do koszyka w celu późniejszego zapisania się.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-3">
                <h2 id="rozdzial-3">3. Zapis na kurs i uczestnictwo</h2>
                <ul>
                    <li>Zapis na kurs jest możliwy przez skompletowanie zamówienia i potwierdzenie zapisu.</li>
                    <li>Po zapisaniu się na kurs, użytkownik otrzymuje potwierdzenie wraz z szczegółami dotyczącymi terminu rozpoczęcia kursu.</li>
                    <li>Maksymalny czas uczestnictwa w jednym kursie wynosi 6 miesięcy, chyba że określono inaczej.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-4">
                <h2 id="rozdzial-4">4. Dostęp do materiałów</h2>
                <ul>
                    <li>Materiały kursowe są udostępniane cyfrowo, bezpośrednio na platformie użytkownika po zapisaniu się na kurs.</li>
                    <li>Użytkownik zobowiązany jest do korzystania z materiałów kursowych wyłącznie w celach edukacyjnych i nieudostępniania ich osobom trzecim.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-5">
                <h2 id="rozdzial-5">5. Kary za naruszenie regulaminu</h2>
                <ul>
                    <li>Za naruszenie regulaminu, w tym udostępnianie materiałów osobom trzecim, użytkownik może zostać obciążony karą umowną oraz usunięty z platformy.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-6">
                <h2 id="rozdzial-6">6. Odpowiedzialność za utratę dostępu lub uszkodzenie treści cyfrowych</h2>
                <ul>
                    <li>Użytkownik jest odpowiedzialny za utratę dostępu lub uszkodzenie materiałów kursowych wynikające z jego działań.</li>
                    <li>W przypadku utraty lub uszkodzenia treści, użytkownik może być obciążony kosztami związanymi z przywróceniem dostępu do kursu.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-7">
                <h2 id="rozdzial-7">7. Zakończenie uczestnictwa</h2>
                <ul>
                    <li>Użytkownik może zakończyć uczestnictwo w kursie w dowolnym momencie, informując o tym administrację languageCourses.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-8">
                <h2 id="rozdzial-8">8. Zmiany w regulaminie</h2>
                <ul>
                    <li>languageCourses zastrzega sobie prawo do wprowadzania zmian w regulaminie. Użytkownicy zostaną poinformowani o wszelkich zmianach przez aktualizacje na stronie internetowej.</li>
                </ul>
            </section>

            <section aria-labelledby="rozdzial-9">
                <h2 id="rozdzial-9">9. Postanowienia końcowe</h2>
                <ul>
                    <li>W przypadku sporów decydujące jest prawo obowiązujące w jurysdykcji siedziby firmy.</li>
                    <li>languageCourses nie ponosi odpowiedzialności za szkody wynikłe z użytkowania serwisu poza zakresem gwarancji usługodawcy.</li>
                </ul>
            </section>
        </div>
    </div>
</main>

@include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
