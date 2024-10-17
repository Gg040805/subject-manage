<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Subject</title>
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

        .form-group label {
            font-weight: 500;
            color: #555;
        }

        .btn {
            border-radius: 0.25rem;
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }

        .btn-primary, .btn-secondary {
            margin-right: 5px;
        }

        /* Add hover effect on buttons */
        .btn:hover {
            opacity: 0.85;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Subject</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="subject_name">Subject Name:</label>
                <input type="text" id="subject_name" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}" required class="form-control">
                @error('subject_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Add other fields as necessary -->

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Subject</button>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subject List</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
