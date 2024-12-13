@include('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - Regulamin'])

<head>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
        ul>li {
            font-weight: lighter;
            color: rgba(0, 0, 0, 0.7); 
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <main class="container mt-5">
        <h1 class="text-success">Regulamin</h1>
        <ol class="text-success fw-bold mt-5">
            <li>Rejestracja
                <ul>
                    <li>Każdy użytkownik pragnący korzystać z usług languageCourses musi zarejestrować się, podając swoje rzeczywiste dane osobowe, w tym imię, nazwisko oraz adres e-mail.</li>
                    <li>Użytkownik zobowiązany jest do aktualizacji swoich danych osobowych w serwisie w przypadku ich zmiany.</li>
                </ul>
            </li>

            <li>Wybór kursów
                <ul>
                    <li>Użytkownicy mają dostęp do szerokiej oferty darmowych kursów językowych dostępnych na platformie languageCourses.</li>
                    <li>Kursy mogą być dodawane do koszyka w celu późniejszego zapisania się.</li>
                </ul>
            </li>

            <li>Zapis na kurs i uczestnictwo
                <ul>
                    <li>Zapis na kurs jest możliwy przez skompletowanie zamówienia i potwierdzenie zapisu.</li>
                    <li>Po zapisaniu się na kurs, użytkownik otrzymuje potwierdzenie wraz z szczegółami dotyczącymi terminu rozpoczęcia kursu.</li>
                    <li>Maksymalny czas uczestnictwa w jednym kursie wynosi 6 miesięcy, chyba że określono inaczej.</li>
                </ul>
            </li>

            <li>Dostęp do materiałów
                <ul>
                    <li>Materiały kursowe są udostępniane cyfrowo, bezpośrednio na platformie użytkownika po zapisaniu się na kurs.</li>
                    <li>Użytkownik zobowiązany jest do korzystania z materiałów kursowych wyłącznie w celach edukacyjnych i nieudostępniania ich osobom trzecim.</li>
                </ul>
            </li>

            <li>Kary za naruszenie regulaminu
                <ul>
                    <li>Za naruszenie regulaminu, w tym udostępnianie materiałów osobom trzecim, użytkownik może zostać obciążony karą umowną oraz usunięty z platformy.</li>
                </ul>
            </li>

            <li>Odpowiedzialność za utratę dostępu lub uszkodzenie treści cyfrowych
                <ul>
                    <li>Użytkownik jest odpowiedzialny za utratę dostępu lub uszkodzenie materiałów kursowych wynikające z jego działań.</li>
                    <li>W przypadku utraty lub uszkodzenia treści, użytkownik może być obciążony kosztami związanymi z przywróceniem dostępu do kursu.</li>
                </ul>
            </li>

            <li>Zakończenie uczestnictwa
                <ul>
                    <li>Użytkownik może zakończyć uczestnictwo w kursie w dowolnym momencie, informując o tym administrację languageCourses.</li>
                </ul>
            </li>

            <li>Zmiany w regulaminie
                <ul>
                    <li>languageCourses zastrzega sobie prawo do wprowadzania zmian w regulaminie. Użytkownicy zostaną poinformowani o wszelkich zmianach przez aktualizacje na stronie internetowej.</li>
                </ul>
            </li>

            <li>Postanowienia końcowe
                <ul>
                    <li>W przypadku sporów decydujące jest prawo obowiązujące w jurysdykcji siedziby firmy.</li>
                    <li>languageCourses nie ponosi odpowiedzialności za szkody wynikłe z użytkowania serwisu poza zakresem gwarancji usługodawcy.</li>
                </ul>
            </li>
        </ol>
    </main>

    @include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
