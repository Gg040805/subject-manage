<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List for All Subjects</title>
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
            text-align: center;
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table td.phone {
            white-space: nowrap; /* Prevent wrapping */
            overflow: hidden; /* Hide overflow */
            text-overflow: ellipsis; /* Add ellipsis for overflowing text */
        }

        .btn {
            border-radius: 0.25rem;
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-secondary {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }

        /* Add hover effect on buttons */
        .btn:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Teachers List for All Subjects</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($teachers->isEmpty())
            <p class="text-center">No teachers available for this subject.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="phone">Phone Number</th> <!-- Add class for styling -->
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->teacher_name }}</td>
                            <td class="phone">{{ $teacher->phone_number }}</td> <!-- Add class for styling -->
                            <td>{{ $teacher->subject->subject_name ?? 'N/A' }}</td>
                            <td>
                                <a href="https://wa.me/{{ $teacher->phone_number }}?text={{ urlencode('Hello, I would like to ask you for some details about your courses.') }}" 
                                   class="btn btn-success btn-sm" 
                                   target="_blank">Message</a>
                                <a href="{{ route('teachers.edit', ['subject_id' => $teacher->subject_id, 'teacher_id' => $teacher->id]) }}" 
                                   class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('teachers.destroy', ['subject_id' => $teacher->subject_id, 'teacher_id' => $teacher->id]) }}" 
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this teacher?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
