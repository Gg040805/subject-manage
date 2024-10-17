<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn {
            border-radius: 0.25rem;
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }

        .btn-primary, .btn-secondary, .btn-info, .btn-warning, .btn-danger {
            margin-right: 5px;
        }

        .table {
            background-color: #fff;
            border-radius: 0.25rem;
        }

        thead th {
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }

        tbody td {
            color: #555;
        }

        /* Add hover effect on buttons */
        .btn:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Students for Subject: {{ $subject->subject_name }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('students.create', $subject->id) }}" class="btn btn-primary mb-3">Add Student</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Teacher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->teacher->teacher_name ?? 'No teacher assigned' }}</td>
                        <td>
                            <a href="{{ route('students.show', ['subject_id' => $subject->id, 'studentId' => $student->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('students.edit', ['subject_id' => $subject->id, 'studentId' => $student->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', ['subject_id' => $subject->id, 'studentId' => $student->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
