@include('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - Koszyk'])
<head>
    <style>
        .container {
            margin-top: 50px;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 15px;
            vertical-align: middle;
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
        .disabled-btn {
            text-decoration: line-through;
        }
        .product-img {
            max-width: 100px;
            margin-right: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            width: 100%;
            padding: 10px;
            position: absolute;
            bottom: 0;
        }
        html, body {
            height: 100%;
        }
        .main-content {
            min-height: 95%;
            display: flex;
            flex-direction: column;
        }
        .content-wrap {
            flex: 1;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="main-content">
        <div class="content-wrap">
            <div class="container">
                <h1 class="text-center">Twój koszyk</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (empty($cartItems))
                    <div class="alert alert-info">
                        Twój koszyk jest pusty.
                    </div>
                @else
                <div class="table-responsive"> 
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Zdjęcie</th>
                                    <th>Nazwa kursu</th>
                                    <th>Opis</th>
                                    <th>Nauczyciel</th>
                                    <th>Data</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $courseId => $item)
                                    <tr>
                                        <td><img src="{{ asset('storage/img/' . $item['course']->path) }}" alt="{{ $item['course']->name }}" class="product-img"></td>
                                        <td>{{ $item['course']->name }}</td>
                                        <td>{{ $item['course']->description }}</td>
                                        <td>{{ $item['course']->teacher->name }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', ['course_id' => $courseId]) }}" method="POST" class="update-date-form">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="date" name="selected_date" class="form-control date-input" value="{{ $item['selected_date'] }}">
                                                </div>
                                                <button type="submit" class="btn btn-info mt-2">Aktualizuj datę</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('cart.remove', ['course_id' => $courseId]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn custom-btn disabled-btn" id="checkout-button" disabled>Zapisz się na kurs</button>
                        </form>
                    </div>                    
                @endif
            </div>
        </div>
        @include('layouts.footer', ['fixedBottom' => false])
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInputs = document.querySelectorAll('.date-input');
            const updateForms = document.querySelectorAll('.update-date-form');
            const checkoutButton = document.getElementById('checkout-button');

            const today = new Date();
            const maxDate = new Date();
            maxDate.setMonth(today.getMonth() + 6);

            const formatDateString = (date) => {
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');
                return `${date.getFullYear()}-${month}-${day}`;
            };

            const minDateString = formatDateString(today);
            const maxDateString = formatDateString(maxDate);

            dateInputs.forEach(input => {
                input.setAttribute('min', minDateString);
                input.setAttribute('max', maxDateString);
            });

            const updateCheckoutButtonState = () => {
                let allDatesSet = true;
                dateInputs.forEach(input => {
                    if (!input.value) {
                        allDatesSet = false;
                    }
                });
                if (allDatesSet) {
                    checkoutButton.disabled = false;
                    checkoutButton.classList.remove('disabled-btn');
                } else {
                    checkoutButton.disabled = true;
                    checkoutButton.classList.add('disabled-btn');
                }
            };

            updateForms.forEach(form => {
                form.addEventListener('submit', function () {
                    setTimeout(updateCheckoutButtonState, 100);
                });
            });

            updateCheckoutButtonState();
        });
    </script>
</body>
</html>
