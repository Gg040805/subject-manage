<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students and Their Courses</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        tbody td {
            text-align: center;
        }
        .btn {
            font-size: 14px;
        }
        .btn-warning {
            background-color: #ffca2c;
            border-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-secondary {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Students and Their Courses</h2>

        @if ($students->isEmpty())
            <p class="alert alert-info text-center">No students available.</p>
        @else
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Phone Number</th>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Action</th> <!-- Added Action column for Edit/Delete buttons -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->subject->subject_name ?? 'No subject assigned' }}</td>
                            <td>{{ $student->teacher->teacher_name ?? 'No teacher assigned' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('students.edit', ['subject_id' => $student->subject_id, 'studentId' => $student->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('students.destroy', ['subject_id' => $student->subject_id, 'studentId' => $student->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE') <!-- Specify that this is a DELETE request -->
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-4">
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for more interactions) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
