<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Details: {{ $teacher->teacher_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4; /* Light gray background */
        }
        .container {
            margin-top: 50px; /* Space above the container */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Teacher Details: {{ $teacher->teacher_name }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $teacher->teacher_name }}</h5>
                <p class="card-text">Phone Number: {{ $teacher->phone_number }}</p>
                <p class="card-text">Subject: {{ $teacher->subject ? $teacher->subject->subject_name : 'N/A' }}</p> <!-- Display subject -->
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('teachers.edit', ['subject_id' => $teacher->subject_id, 'teacher_id' => $teacher->id]) }}" class="btn btn-warning">Edit Teacher</a>
                <form action="{{ route('teachers.destroy', ['subject_id' => $teacher->subject_id, 'teacher_id' => $teacher->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?');">Delete Teacher</button>
                </form>


                <a href="{{ route('teachers.index', ['subject_id' => $teacher->subject_id]) }}" class="btn btn-secondary">Back to All Teachers</a>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
