<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            color: #007bff;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #5a6268;
        }

        .details {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Details</h2>

        <div class="details">
            <p><strong>Name:</strong> {{ $student->student_name }}</p>
            <p><strong>Phone Number:</strong> {{ $student->phone_number }}</p>
            <p><strong>Subject:</strong> {{ $subject->subject_name }}</p> <!-- Use subject passed from controller -->
        </div>

        <a href="{{ route('students.index', $subject->id) }}">Back to Student List</a>
    </div>
</body>
</html>
