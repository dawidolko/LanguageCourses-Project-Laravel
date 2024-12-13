@include('layouts.html')
@include('layouts.head', ['pageTitle' => 'languageCourses - Admin Kursy'])
<head>
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
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

        <h1>Wszystkie kursy</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="#" class="btn btn-secondary custom-btn" onclick="toggleAddPanel(event, 'course')">Dodaj kurs</a>
            <a href="#" class="btn btn-secondary custom-btn" onclick="toggleAddPanel(event, 'lesson')">Dodaj lekcję</a>
            <a href="#" class="btn btn-secondary custom-btn" onclick="toggleAddPanel(event, 'teacher')">Dodaj nauczyciela</a>
        </div>

        <li id="add-panel-course" class="list-group-item edit-panel" style="display: none;">
            <form action="{{ route('admin.addCourse') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nazwa kursu</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="language">Język</label>
                    <input type="text" class="form-control" id="language" name="language" required>
                </div>
                <div class="form-group">
                    <label for="teacher_id">Nauczyciel</label>
                    <select class="form-control" id="teacher_id" name="teacher_id" required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Zdjęcie</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-secondary custom-btn m-2">Dodaj</button>
            </form>
        </li>

        <li id="add-panel-lesson" class="list-group-item edit-panel" style="display: none;">
            <form action="{{ route('admin.addLesson') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Tytuł lekcji</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="course_id">Kurs</label>
                    <select class="form-control" id="course_id" name="course_id" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary custom-btn m-2">Dodaj</button>
            </form>
        </li>

        <li id="add-panel-teacher" class="list-group-item edit-panel" style="display: none;">
            <form action="{{ route('admin.addTeacher') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Imię i nazwisko nauczyciela</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <button type="submit" class="btn btn-secondary custom-btn m-2">Dodaj</button>
            </form>
        </li>

        <div class="table-responsive"> 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Zdjęcie</th>
                    <th style="text-align: center">Nazwa kursu</th>
                    <th style="text-align: center">Opis</th>
                    <th style="text-align: center">Język</th>
                    <th style="text-align: center">Nauczyciel</th>
                    <th style="text-align: center">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td><img src="{{ asset('storage/img/' . $course->path) }}" alt="{{ $course->name }}" width="100"></td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->language }}</td>
                    <td>{{ $course->teacher->name }}</td>
                    <td>
                        <button type="button" class="btn btn-secondary" onclick="openEditPanel({{ $course->id }})" style="margin-bottom: 10px;">Edytuj</button>
                        <form action="{{ route('admin.deleteCourse', ['id' => $course->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
                <tr id="edit-panel-{{ $course->id }}" style="display: none;">
                    <td colspan="7">
                        <form id="edit-form-{{ $course->id }}" method="POST" action="{{ route('admin.updateCourse', ['id' => $course->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nazwa kursu</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea class="form-control" id="description" name="description" required>{{ $course->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="language">Język</label>
                                <input type="text" class="form-control" id="language" name="language" value="{{ $course->language }}" required>
                            </div>
                            <div class="form-group">
                                <label for="teacher_id">Nauczyciel</label>
                                <select class="form-control" id="teacher_id" name="teacher_id" required>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Zdjęcie</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary custom-btn m-2">Zapisz</button>
                            <button type="button" class="btn btn-secondary custom-btn m-2" onclick="closeEditPanel({{ $course->id }})">Anuluj</button>
                        </form>
                    </td>
                </tr>                
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $courses->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    @include('layouts.footer', ['fixedBottom' => false])
    <script>
        function toggleAddPanel(event, type) {
            event.preventDefault();
            let panel = `add-panel-${type}`;
            let display = document.getElementById(panel).style.display;
            document.getElementById(panel).style.display = display === 'none' ? 'block' : 'none';
        }

        function openEditPanel(courseId) {
            document.getElementById('edit-panel-' + courseId).style.display = 'table-row';
        }

        function closeEditPanel(courseId) {
            document.getElementById('edit-panel-' + courseId).style.display = 'none';
        }
    </script>
</body>
</html>
