@extends('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - Admin Zapisy'])

<head>
    <style>
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            padding: 15px;
            vertical-align: middle;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            width: 100%;
            padding: 10px;
            position: absolute;
            bottom: 0;
        }
        .main-content {
            min-height: 90vh;
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
        <div class="container mt-5">
            <h1 class="text-center">Zapisy</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="table-responsive"> 
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Użytkownik</th>
                            <th>Kurs</th>
                            <th>Data lekcji</th>
                            <th>Status</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->id }}</td>
                                <td>{{ $enrollment->user->name }}</td>
                                <td>{{ $enrollment->lessons->first()->course->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($enrollment->lesson_date)->format('Y-m-d') }}</td>
                                <td>{{ $enrollment->status }}</td>
                                <td>
                                    <a href="{{ route('admin.enrollments.edit', $enrollment->id) }}" class="btn btn-info btn-sm">Edytuj</a>
                                    <form action="{{ route('admin.enrollments.delete', $enrollment->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $enrollments->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer', ['fixedBottom' => true])
</body>
</html>
