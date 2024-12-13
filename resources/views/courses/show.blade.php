@include('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - '.$course->name])
<head>
    <link rel="stylesheet" href="{{ asset('css/courseStyle.css') }}" />
</head>
<body>
    @include('layouts.navbar')

    <div class="produkt new-conti category-section container">
        <div class="product-main">
            <div class="product-grid">
                <div class="showcase">
                    <div class="slider showcase-banner">
                        <img src="{{ asset('storage/img/' . $course->path) }}" alt="{{ $course->language }}" width="300" class="product-img hover" />
                        <img src="{{ asset('storage/img/' . $course->path) }}" alt="{{ $course->language }}" width="300" class="product-img default" />
                    </div>
                    <div class="showcase-content">
                        <div class="caseBox-info">
                            <div class="caseBox1">
                                <a style="text-align: center;" href="{{ route('courses.show', ['id' => $course->id]) }}" class="showcase-category card-title text-danger2">{{ $course->language }}</a>
                                <a href="{{ route('courses.show', ['id' => $course->id]) }}">
                                    <h3 style="text-align: center;" class="showcase-title">{{ $course->name }}</h3>
                                </a>
                                <p>Dostępne lekcje dla kursu:</p>
                                <ul>
                                    @foreach ($lessons as $lesson)
                                        <li>
                                            <strong>{{ $lesson->title }}</strong>: {{ $lesson->description }}
                                        </li>
                                    @endforeach
                                </ul>
                                <hr />
                                <h4 class="card-title" style="margin: 10px;">Opis</h4>
                                <div class="product-description">{{ $course->description }}</div>
                                <hr />
                                <h4 class="card-title" style="margin: 10px;">Nauczyciel</h4>
                                <div class="product-description">
                                    <strong>Imię i nazwisko:</strong> {{ $teacher->name }}<br>
                                    <strong>Email:</strong> {{ $teacher->email }}<br>
                                    <strong>Telefon:</strong> {{ $teacher->phone }}
                                </div>
                                <hr />
                                <div class="cart-favorite">
                                    <div class="login-btn">
                                        @if (Auth::check())
                                        <form action="{{ route('cart.add', ['course_id' => $course->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-block custom-btn">
                                                <b>Dodaj do koszyka "{{ $course->name }}"</b>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-block custom-btn">
                                            <b>Zaloguj się, aby się zapisać "{{ $course->name }}"</b>
                                        </a>
                                    @endif                                    
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer', ['fixedBottom' => false])
</body>
</html>
