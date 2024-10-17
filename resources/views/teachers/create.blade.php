<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        .form-control {
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Teacher for Subject: {{ $subject->subject_name ?? 'Subject Not Found' }}</h2>

        <form action="{{ route('teachers.store', $subject->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="teacher_name">Teacher Name</label>
                <input type="text" name="teacher_name" id="teacher_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" 
                       pattern="^01[0-9]{8,9}$" 
                       placeholder="e.g. 0123456789" 
                       title="Please enter a valid Malaysian phone number (e.g. 0123456789)">
            </div>
            <button type="submit" class="btn btn-primary">Add Teacher</button>
            <a href="{{ route('teachers.index', $subject->id) }}" class="btn btn-secondary">Teacher List</a>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>
        </form>
    </div>
</body>
</html>
