@include('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - 404'])
<head>
    <style>
        html, body {
            height: 100%; 
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; 
        }

        .container {
            flex: 1; 
            display: flex;
            flex-direction: column; 
            justify-content: center;
        }

        .footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="container mt-5 mb-5">
    @if (session('error'))
        <div class="row d-flex justify-content-center">
            <div class="alert alert-danger">{{ session('error') }}</div>
        </div>
    @endif
    <div class="row mt-4 mb-4 text-center card">
        <h1 class="display-1 fw-bold">404</h1>
        <h2>
            @if (App::environment('local'))
                {{ $exception->getMessage() ?: 'Nie znaleziono strony' }}
            @else
                Nie znaleziono strony
            @endif
        </h2>
        <p>Przepraszamy, strona, której szukasz, nie istnieje lub została przeniesiona. Spróbuj <a href="{{ url('/') }}">wrócić na stronę główną</a> lub skontaktuj się z nami, jeśli potrzebujesz dalszej pomocy.</p>
    </div>

    @include('layouts.validation-error')
</div>

@include('layouts.footer', ['fixedBottom' => false])
<script>
    document.getElementById("navbar-user").remove();
</script>
</body>
</html>
