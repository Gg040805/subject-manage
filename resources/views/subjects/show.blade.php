<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject->subject_name }} - Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 50px;
        }
        h2, h3 {
            color: #007bff;
        }
        .btn-secondary, .btn-success {
            margin-right: 10px;
        }
        .btn-message {
            margin-left: 10px;
        }
        .phone-number {
            width: 100%; /* Make phone input full width */
            padding: 0.375rem 0.75rem; /* Add padding */
            border: 1px solid #ced4da; /* Border */
            border-radius: 0.25rem; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">{{ $subject->subject_name }} - Details</h2>

        <!-- Success message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('subjects.show', $subject->id) }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search for teachers or students" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Buttons to add new teachers or students -->
        <div class="mb-3">
            <a href="{{ route('teachers.create', $subject->id) }}" class="btn btn-secondary me-2">Add New Teacher</a>
            <a href="{{ route('students.create', $subject->id) }}" class="btn btn-secondary">Add New Student</a>
        </div>
            
        <!-- Section for Teachers -->
        <h3>Teachers for this Subject</h3>
        @if (isset($teachers) && count($teachers) === 0)
            <p>No teachers available for this subject.</p>
        @else
            <ul class="list-group mb-4">
                @foreach ($teachers as $teacher)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $teacher->teacher_name }} - <input type="text" class="phone-number" value="{{ $teacher->phone_number }}" readonly />
                        </div>
                        <a href="https://wa.me/{{ $teacher->phone_number }}?text={{ urlencode('Hello, I would like to ask you for some details about this subject: ' . $subject->subject_name) }}" 
                           class="btn btn-success btn-sm btn-message" 
                           target="_blank">Message</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Section for Students -->
        <h3>Students for this Subject</h3>
        @if (isset($students) && count($students) === 0)
            <p>No students available for this subject.</p>
        @else
            <ul class="list-group mb-4">
                @foreach ($students as $student)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $student->student_name }} - <input type="text" class="phone-number" value="{{ $student->phone_number }}" readonly />
                        </div>
                        <a href="https://wa.me/{{ $student->phone_number }}?text={{ urlencode('Hello, I would like to ask about how is your study progress in class ' . $subject->subject_name) }}" 
                           class="btn btn-success btn-sm btn-message" 
                           target="_blank">Message</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Additional Links -->
        <div class="mb-4">
            <a href="{{ route('students.index', $subject->id) }}" class="btn btn-info">View Student List</a>
        </div>

        <!-- Back to Subject List -->
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
