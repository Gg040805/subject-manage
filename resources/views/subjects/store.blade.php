<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Created</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Subject Created Successfully!</h2>

        <p>The subject has been created. You can go back to the subject list.</p>

        <a href="{{ route('subjects.index') }}">Back to Subject List</a>
    </div>
</body>
</html>
