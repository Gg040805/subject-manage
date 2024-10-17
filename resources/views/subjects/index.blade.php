<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9; /* Soft off-white background */
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #333; /* Dark gray for modern look */
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }

        .navbar {
            background-color: #fff; /* Simple white navbar */
            border-bottom: 1px solid #e0e0e0;
        }

        .navbar-brand {
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .input-group .form-control {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .input-group-append .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .list-group-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            margin-bottom: 10px;
        }

        .font-weight-bold {
            color: #007bff;
            font-weight: 600;
        }

        .btn-primary, .btn-danger, .btn-secondary, .btn-info {
            border-radius: 0.25rem;
            padding: 0.4rem 0.75rem;
            font-size: 0.85rem;
            margin: 5px;
        }

        .btn-primary:hover, .btn-danger:hover, .btn-secondary:hover, .btn-info:hover {
            opacity: 0.85;
        }

        .action-buttons .btn {
            margin-left: 5px;
        }

        .text-center .btn {
            margin: 0.3rem;
        }

        /* Remove button outline on click */
        button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Subject Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @if(session('loggedIn'))
                    <span class="navbar-text mr-3" style="margin-right: auto;">Logged in as {{ session('username') }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="form-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Subject List</h2>

        <!-- Search Form -->
        <form action="{{ route('subjects.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search by subject, teacher, or student name" value="{{ request('query') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Alert for Success -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Subject List -->
        @if ($subjects->isEmpty())
            <p class="text-center">No subjects available.</p>
        @else
            <ul class="list-group">
                @foreach ($subjects as $subject)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="font-weight-bold">{{ $subject->subject_name }}</a>
                            <div class="action-buttons">
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subject?');">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="mt-2">
                            @foreach ($subject->teachers as $teacher)
                                <a href="{{ route('teachers.show', ['subject_id' => $subject->id, 'teacher_id' => $teacher->id]) }}" class="btn btn-secondary btn-sm">
                                    View Teacher: {{ $teacher->teacher_name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
        <!-- Additional Actions -->
        <div class="text-center mt-3">
            <a href="{{ route('subjects.create') }}" class="btn btn-success">Add New Subject</a>
            <a href="{{ route('students.showall') }}" class="btn btn-secondary">View All Students and Courses</a>
            
            <a href="{{ route('viewallteacher') }}" class="btn btn-info">View All Teachers</a> 
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
