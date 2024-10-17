<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #f0f4f8; /* Light background color */
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 600px; /* Limit the width for better alignment */
            margin: auto; /* Center the container */
            padding: 20px;
            background-color: #ffffff; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        h2 {
            text-align: center;
            color: #007bff; /* Primary color for the heading */
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .alert {
            margin-top: 10px;
        }

        .btn {
            width: 100%; /* Make buttons full width */
            margin-top: 10px; /* Space between buttons */
            color: #ffffff; /* Button text color */
            border: none; /* Remove border */
            border-radius: 0.25rem; /* Rounded corners */
            padding: 10px; /* Padding for buttons */
            font-size: 16px; /* Font size */
            transition: background-color 0.3s ease; /* Transition for hover effect */
        }

        .btn-update {
            background-color: #28a745; /* Green for update button */
        }

        .btn-update:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .btn-back-teacher {
            background-color: #007bff; /* Blue for back to teacher list button */
        }

        .btn-back-teacher:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .btn-back-subject {
            background-color: #ffc107; /* Yellow for back to subject list button */
        }

        .btn-back-subject:hover {
            background-color: #e0a800; /* Darker yellow on hover */
        }

        input[type="text"], select {
            width: 100%; /* Make input and select full width */
            padding: 0.375rem 0.75rem; /* Add padding */
            border: 1px solid #ced4da; /* Border */
            border-radius: 0.25rem; /* Rounded corners */
            font-size: 16px; /* Larger font size */
            transition: border-color 0.3s ease; /* Transition for border color on focus */
        }

        input[type="text"]:focus, select:focus {
            border-color: #007bff; /* Focus border color */
            outline: none; /* Remove outline */
            box-shadow: 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Focus shadow */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Teacher: {{ $teacher->teacher_name }}</h2>

        <form action="{{ route('teachers.update', ['subject_id' => $teacher->subject_id, 'teacher_id' => $teacher->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Specify that this is a PUT request for updating -->

            <div class="form-group">
                <label for="teacher_name">Teacher Name</label>
                <input type="text" name="teacher_name" id="teacher_name" class="form-control" value="{{ old('teacher_name', $teacher->teacher_name) }}" required>
                @error('teacher_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" 
                       value="{{ old('phone_number', substr($teacher->phone_number, 1)) }}" <!-- Remove the leading '6' for input -->
                       Example= 0123456789
                @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject->id == $teacher->subject_id ? 'selected' : '' }}>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
                @error('subject_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-update">Update Teacher</button><br><br>
            <a href="{{ route('teachers.index', $teacher->subject_id) }}" class="btn btn-back-teacher">Back to Teacher List</a>
            <a href="{{ route('subjects.index') }}" class="btn btn-back-subject">Back to Subject List</a>
        </form>
    </div>
</body>
</html>
