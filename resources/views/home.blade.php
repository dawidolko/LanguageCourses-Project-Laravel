@include('layouts.html')
  
  @include('layouts.head', ['pageTitle' => 'languageCourses - strona główna'])
  <head>
    <style>
      .custom-carousel-item {
          height: 66.67vh;
      }

      .custom-carousel-img {
          height: 100%;
          object-fit: cover;
      }
      .custom-carousel-control-prev-icon,
      .custom-carousel-control-next-icon {
          background-color: black;
          padding: 20px;
          background-image: none;
      }

      .custom-carousel-control-prev-icon::after,
      .custom-carousel-control-next-icon::after {
          content: '';
          display: inline-block;
          width: 20px;
          height: 20px;
          border: solid white;
          border-width: 0 3px 3px 0;
          padding: 3px;
      }

      .custom-carousel-control-prev-icon::after {
          transform: rotate(135deg);
      }

      .custom-carousel-control-next-icon::after {
          transform: rotate(-45deg);
      }

      .carousel-caption {
          background: rgba(0, 0, 0, 0.5);
          padding: 20px;
          border-radius: 10px; 
      }

      .carousel-caption h1 {
          margin: 0;
      }

      .shadow-title {
        background: rgba(0, 0, 0, 0.5);
        margin: auto;
        margin-top: 20px;
        padding: 10px;
      }
    </style>
  </head>
  <body>
    @include('layouts.navbar')
    <hr>
    <div id="start">
      <div id="carouselExampleCaptions" class="carousel slide custom-carousel">
          <div class="carousel-inner">
              <div class="carousel-item active custom-carousel-item">
                  <img src="img/carousel3.jpg" class="d-block w-100 custom-carousel-img" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                      <h1 class="text-white">languageCourses - siła jęzków</h1>
                  </div>
              </div>
              <div class="carousel-item custom-carousel-item">
                  <img src="img/carousel2.jpg" class="d-block w-100 custom-carousel-img" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                      <h1 class="text-white">languageCourses - łatwa nauka</h1>
                  </div>
              </div>
              <div class="carousel-item custom-carousel-item">
                  <img src="img/carousel1.jpg" class="d-block w-100 custom-carousel-img" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                      <h1 class="text-white">languageCourses - prosto i dostępnie</h1>
                  </div>
              </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="custom-carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="custom-carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
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
<hr>
  
    @include('layouts.footer', ['fixedBottom' => false])
  </body>
</html>
