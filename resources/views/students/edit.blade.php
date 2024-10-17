<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .alert {
            margin-top: 5px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        .form-group select, .form-group input {
            box-sizing: border-box;
        }

        /* Flexbox for better layout */
        .form-group,
        button {
            display: flex;
            justify-content: space-between;
        }

        .form-group input,
        .form-group select {
            flex-grow: 1;
        }

        button {
            width: 48%;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Student: {{ $student->student_name }}</h2>

        <form action="{{ route('students.update', ['subject_id' => $student->subject_id, 'studentId' => $student->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Student Name Input -->
            <div class="form-group">
                <label for="student_name">Student Name</label>
                <input type="text" name="student_name" id="student_name" class="form-control" value="{{ old('student_name', $student->student_name) }}" required>
                @error('student_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number Input -->
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', substr($student->phone_number, 1)) }}" 
                       pattern="^01[0-9]{8,9}$" placeholder="e.g. 0123456789" title="Please enter a valid Malaysian phone number (e.g. 0123456789)">
                @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subject Selection -->
            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject->id == $student->subject_id ? 'selected' : '' }}>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
                @error('subject_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Teacher Selection -->
            <div class="form-group">
                <label for="teacher_id">Teacher</label>
                <select name="teacher_id" id="teacher_id" class="form-control" required>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $student->teacher_id ? 'selected' : '' }}>
                            {{ $teacher->teacher_name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Back Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('students.index', $student->subject_id) }}" class="btn btn-secondary">Back to Student List</a>
            </div>
        </form>
    </div>
</body>
</html>
