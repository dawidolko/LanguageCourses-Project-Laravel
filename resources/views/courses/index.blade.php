@include('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - Kursy'])
<head>
    <link rel="stylesheet" href="{{ asset('css/courseStyle.css') }}" />
    <style>
        @media (min-width: 780px) {
            /**
            * #PRODCUT GRID
            */
            .product-grid {
                margin: 50px;
                -ms-grid-columns: 1fr 30px 1fr 30px 1fr 30px 1fr;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

 
    <div class="container text-white w-50" style="margin-top:80px;">
        <form action="{{ route('courses.index') }}" method="GET" class="row">
            <div class="form-group col-md-6">
                <label for="name">Nazwa Kursu</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
            </div>
            <div class="form-group col-md-6">
                <label for="language">Język</label>
                <select name="language" id="language" class="form-control">
                    <option value="">Wszystkie</option>
                    @foreach ($languages as $language)
                        <option value="{{ $language->language }}" {{ request('language') == $language->language ? 'selected' : '' }}>
                            {{ $language->language }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 text-center">
                <button type="submit" class="btn custom-btn m-2">Filtruj</button>
            </div>
        </form>
    </div>

    <div class="new-conti category-section mt-8">
        <div class="product-main">
            <hr>
            <h2 class="title shadow-title text-dark">Zapisz się na kurs już dziś</h2>
            <hr>

            <div class="product-grid">
                @if ($courses->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        BRAK KURSÓW
                    </div>
                @else
                    @foreach ($courses as $course)
                        <div class="showcase">
                            <div class="showcase-banner">
                                <img src="{{ asset('storage/img/' . $course->path) }}" alt="{{ $course->language }}" width="300" class="product-img hover" />
                                <img src="{{ asset('storage/img/' . $course->path) }}" alt="{{ $course->language }}" width="300" class="product-img default" />
                            </div>

                            <div class="showcase-content">
                                <a style="text-align: center;" href="{{ route('courses.show', ['id' => $course->id]) }}" class="showcase-category card-title text-danger2">{{ $course->language }}</a>

                                <a href="{{ route('courses.show', ['id' => $course->id]) }}">
                                    <h3 style="text-align: center;" class="showcase-title">{{ $course->name }}</h3>
                                </a>
                                <div class="card-body">
                                    <a href="{{ route('courses.show', ['id' => $course->id]) }}" class="w-100 h-100 btn btn-block custom-btn"><b>Przejdź do kursu</b></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif    
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-4') }}
        </div>
    </div>

    @include('layouts.footer', ['fixedBottom' => false])
</body>
</html>