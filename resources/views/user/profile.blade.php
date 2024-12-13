@include('layouts.html')
@include('layouts.head', ['pageTitle' => 'languageCourses - Profil użytkownika'])
<head>
    <style>
        .marginbig { display: flex; flex-direction: column; justify-content: center; height: 100vh; }
        .custom-btn { background-color: gray; color: black; border: none; }
        .custom-btn:hover { background-color: lightgreen; color: white; }
        .full-height { min-height: 87vh; display: flex; flex-direction: column; justify-content: center; }
        .text-large { font-size: 1.5em; text-align: center; }
        .footer { margin-top: auto; }
        .img-fluid { max-width: 100%; height: auto; }
        .table th, .table td {
            padding: 8px; 
            text-align: center;
            vertical-align: middle;
        }
        .table th:last-child, .table td:last-child {
            width: 30%; 
        }
        textarea {
            width: 100%; 
            height: 100px; 
        }
        .img { width: 100px; }
        .date-input { max-width: 150px; }
        .btn-info:hover{
            background-color: #0080ff;
        }
        .needs-validation{
            width: 50%;
        }
        .photo{
            width: 50%;
            display: flex;
            gap: 20px;
        }
    </style>
</head>
<body style="overflow-x: hidden;">
@include('layouts.navbar')

<div class="row mt-4 mb-4 text-center" style="text-align: center;">
    <div class="col-12" style="    display: flex;
    flex-direction: column;
    align-items: center;">
        <img src="{{ asset('storage/img/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px; margin-bottom: 20px; border-radius: 50">
        <h1>Twój profil</h1>
    </div>
</div>

@if (Auth::check())
<div class="container mt-5 marginbig">
    <div class="card">
        <div class="card-header" style="padding: 20px;">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="flex-grow-1 mb-3 mb-md-0">
                    <h1>{{ Auth::user()->name }}</h1>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Adres:</strong> {{ Auth::user()->address }}</p>
                    <div>
                        <a href="{{ route('user.settings') }}" class="btn custom-btn btn-test">Edytuj dane</a>
                        <a href="{{ route('user.cart') }}" class="btn custom-btn btn-test">Koszyk</a>
                        <a href="{{ route('logout') }}" class="btn custom-btn btn-test">Wyloguj</a>
                    </div>
                </div>
    
                <div class="photo text-center">
                    <img src="{{ url(Auth::user() ? Auth::user()->avatar : 'storage/img/user.png') }}" class="rounded-circle" height="100" alt="Portrait of a User" loading="lazy"/>
                    <form method="POST" action="{{ route('user.update_avatar') }}" enctype="multipart/form-data" class="needs-validation mt-3" novalidate>
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
    </div>    
    <div class="card mt-4">
        <div class="card-header" style="padding: 20px;">
            <h2>Zapisane kursy</h2>
        </div>
        <div class="card-body">
            @if($enrollments->isEmpty())
                <p>Brak zapisanych kursów.</p>
            @else
                <div class="table-responsive"> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Zdjęcie</th>
                                <th>Nazwa kursu</th>
                                <th>Nauczyciel</th>
                                <th>Data zapisu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                                <tr>
                                    <td><img src="{{ asset('storage/img/' . $enrollment->lessons->first()->course->path) }}" class="img-fluid img"></td>
                                    <td>{{ $enrollment->lessons->first()->course->name }}</td>
                                    <td>{{ $enrollment->lessons->first()->course->teacher->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($enrollment->lesson_date)->format('Y-m-d') }}</td>
                                    <td>{{ ucfirst($enrollment->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@else
    <div class="full-height">
        <p class="text-large">Proszę się zalogować, aby uzyskać dostęp do profilu.</p>
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn custom-btn">Zaloguj się</a>
        </div>
    </div>
@endif

@include('layouts.footer', ['fixedBottom' => false])
<script>
    function toggleReviewForm(loanId) {
        var form = document.getElementById('review-form-' + loanId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.needs-validation');
        form.addEventListener('submit', function (event) {
            const fileInput = document.getElementById('avatar');
            let valid = true;
    
            if (fileInput.files.length === 0) {
                valid = false;
                fileInput.classList.add('is-invalid');
            } else {
                fileInput.classList.remove('is-invalid');
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
