<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Your CSS file -->
    <style>
        body {
            background-color: #f9f9f9; /* Soft background color */
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 400px; /* Set a maximum width for the form */
            margin-top: 100px; /* Centering the form vertically */
            padding: 20px;
            background-color: #fff; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        h2 {
            text-align: center; /* Center the heading */
            color: #333; /* Dark gray color for the heading */
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold; /* Make labels bold */
        }

        button[type="submit"] {
            width: 100%; /* Full-width button */
            background-color: #007bff; /* Primary blue color */
            border: none; /* No border */
            color: white; /* White text */
            padding: 10px; /* Padding for the button */
            border-radius: 5px; /* Rounded corners */
        }

        button[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .alert {
            margin-bottom: 20px; /* Space below alerts */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
