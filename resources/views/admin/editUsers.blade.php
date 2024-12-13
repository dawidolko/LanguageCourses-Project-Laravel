@include('layouts.html')
@include('layouts.head', ['pageTitle' => 'languageCourses - Admin użytkownicy'])

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/moviesStyle.css') }}">
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
        }

        .footer {
            margin-top: auto;
        }

        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .list-group-item {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .user-info {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }
        .user-info > span {
            margin-right: 15px;
            white-space: nowrap;
        }
        .button-group a {
            margin-right: 10px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .btn-secondary{
            margin-right: 10px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
        <div class="container w-100">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <h1>Wszyscy klienci</h1>
        <div class="table-responsive"> 
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Awatar</th>
                    <th style="text-align: center">Imię i nazwisko</th>
                    <th style="text-align: center">Email</th>
                    <th style="text-align: center">Data założenia konta</th>
                    <th style="text-align: center">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><img src="{{ asset($user->avatar) }}" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                    <td style="display: flex;">
                        <a href="#" class="btn btn-secondary" onclick="toggleEditPanel('{{ $user->id }}')">Edytuj</a>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">Usuń</button>
                        </form>
                    </td>
                </tr>
                <tr id="edit-panel-{{ $user->id }}" style="display: none;">
                    <td colspan="7">
                        <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name-{{ $user->id }}">Imię i nazwisko</label>
                                <input type="text" class="form-control" id="name-{{ $user->id }}" name="name" required value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email-{{ $user->id }}">Email</label>
                                <input type="email" class="form-control" id="email-{{ $user->id }}" name="email" required value="{{ $user->email }}">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="admin-{{ $user->id }}" name="admin" @if($user->isAdmin()) checked @endif>
                                <label class="form-check-label" for="admin-{{ $user->id }}">Administrator</label>
                            </div>
                            <button type="submit" class="btn btn-secondary m-2 w-30">Zapisz</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-4') }} 
            </div>
        </div>
    </div>
    
    @include('layouts.footer', ['fixedBottom' => false])
    <script>
        function toggleEditPanel(userId) {
            var editPanel = document.getElementById('edit-panel-' + userId);
            if (editPanel.style.display === 'none') {
                editPanel.style.display = 'table-row';
            } else {
                editPanel.style.display = 'none';
            }
        }
    </script>       
</body>
</html>
