<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add Student for {{ $subject->subject_name }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('students.store', $subject->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter the student's name.
                </div>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" maxlength="15">
                <small class="form-text text-muted">Optional. Format: 60123456789 (6 followed by the number).</small>
            </div>
            <div class="form-group">
                <label for="teacher_id">Select Teacher:</label>
                <select id="teacher_id" name="teacher_id" class="form-control" required>
                    <option value="">-- Select a Teacher --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Please select a teacher.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
        <a href="{{ route('subjects.index') }}">Back to Subject List</a>
        <a href="{{ route('students.index', $subject->id) }}" class="btn btn-link">Back to Student List</a>
    </div>
</body>
</html>
