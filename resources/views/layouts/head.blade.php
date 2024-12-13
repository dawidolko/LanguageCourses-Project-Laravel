<head>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image/webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/coursesStyle.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script defer src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: rgb(202, 202, 202);
        }
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
        }
        p, a, li, span {
            font-weight: 400;
        }
        .green-after:hover {
            color: rgba(0, 88, 15, 0.8);;
        }
        .navbar, .container-fluid {
            background-color: rgb(168, 165, 165);
        }
    </style>    
</head>
