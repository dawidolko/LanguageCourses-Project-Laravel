@extends('layouts.html')

@include('layouts.head', ['pageTitle' => 'languageCourses - Admin Edytuj Zapis'])
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
            min-height: 85vh;
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

<div class="container mt-5 main-content">
    <h1 class="text-center">Edytuj Zapis</h1>

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

    <form action="{{ route('admin.enrollments.update', $enrollment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ $enrollment->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-info mt-3">Zaktualizuj</button>
    </form>
</div>

@include('layouts.footer', ['fixedBottom' => true])
</body>
</html>
