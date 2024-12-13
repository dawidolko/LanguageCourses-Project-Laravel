@include('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - Ustawienia konta'])
<head>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            position: relative;
            width: 100%;
            clear: both;
        }
        .custom-btn {
            background-color: gray;
            color: black;
            border: none;
        }
        .custom-btn:hover {
            background-color: lightgreen;
            color: white;
        }
        .container {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .full-height {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .text-large {
            font-size: 1.5em;
            text-align: center;
        }
    </style>
</head>

<body>
@include('layouts.navbar')

@if (Auth::check())
<div class="container mt-5 mb-5 marginbig">
    @include('layouts.session-error')

    <div class="row mt-4 mb-4 text-center">
        <div class="col-12">
            <img src="{{ asset('storage/img/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px; margin-bottom: 20px; border-radius: 50%">
            <h1>Ustawienia konta</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('user.update_name') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Imię i nazwisko</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn custom-btn">Zapisz zmiany</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('user.update_avatar') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="avatar" class="form-label">Zmień awatar</label>
                        <input id="avatar" name="avatar" type="file" class="form-control" required>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn custom-btn">Zaktualizuj awatar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('user.change_password') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="current_password" class="form-label">Obecne Hasło</label>
                        <input id="current_password" name="current_password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="new_password" class="form-label">Nowe Hasło</label>
                        <input id="new_password" name="new_password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="new_password_confirmation" class="form-label">Potwierdzenie Nowego Hasła</label>
                        <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn custom-btn">Zmień hasło</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@else
    <div class="full-height">
        <p class="text-large">Proszę się zalogować, aby uzyskać dostęp do ustawień konta.</p>
    </div>
@endif

@include('layouts.footer', ['fixedBottom' => false])
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const settingsForm = document.querySelector('.needs-validation');
        settingsForm.addEventListener('submit', function (event) {
            const name = document.getElementById('name');
            let valid = true;

            if (!name.value.match(/^[a-zA-Z\s]+$/)) {
                valid = false;
                alert('Imię i nazwisko może zawierać tylko litery i spacje.');
            }

            if (!valid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });
</script>

</body>
</html>
