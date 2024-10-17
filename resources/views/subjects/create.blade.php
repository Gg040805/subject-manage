<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background for contrast */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px; /* Adjusted width for mobile */
            margin: 20px auto; /* Centered container with margin */
            padding: 20px;
            background: white; /* White background for form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        h2 {
            text-align: center; /* Centered heading */
            color: #333; /* Darker text for contrast */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold; /* Bold labels */
        }

        .form-group input {
            width: 100%; /* Full width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Soft inner shadow */
        }

        .button {
            width: 100%; /* Full width buttons */
            background-color: #007bff; /* Blue color */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px; /* Space between buttons */
            transition: background-color 0.3s; /* Transition effect */
        }

        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .alert {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .container {
                padding: 15px; /* Less padding on small screens */
            }

            .button {
                padding: 12px; /* Slightly larger padding for touch targets */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Subject</h2>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="subject_name">Subject Name:</label>
                <input type="text" id="subject_name" name="subject_name" required>
            </div>
            <button type="submit" class="button">Add Subject</button>
        </form>

        <button class="button" onclick="window.location.href='{{ route('subjects.index') }}'">Return to Subject List</button><br><br>
        <a href="{{ route('subjects.index') }}" class="button">View All Subjects</a>
    </div>
</body>
</html>
