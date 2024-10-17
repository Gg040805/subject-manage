<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查看科目</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .subject-details {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .subject-details h2 {
            margin-bottom: 20px;
        }

        .subject-details p {
            margin: 10px 0;
        }

        .button {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="subject-details">
            <h2>科目详情: {{ $subject->subject_name }}</h2>
            <p><strong>科目 ID:</strong> {{ $subject->id }}</p>
            <p><strong>科目名称:</strong> {{ $subject->subject_name }}</p>
            
            <a href="{{ route('subject.create') }}" class="button">添加新科目</a>
            <a href="{{ route('subjects.edit', $subject->id) }}" class="button">编辑科目</a>
            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button" onclick="return confirm('确定要删除此科目吗？')">删除科目</button>
            </form>
        </div>
    </div>
</body>
</html>
