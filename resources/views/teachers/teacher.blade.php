<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Teacher</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Create New Teacher</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teachers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="teacher_name">Teacher Name:</label>
                <input type="text" name="teacher_name" id="teacher_name" class="form-control" value="{{ old('teacher_name') }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
            </div>

            <div class="form-group">
                <label for="subject_id">Assign Subject:</label>
                <select name="subject_id" id="subject_id" class="form-control">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Teacher</button>
        </form>

        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back to Teacher List</a>
    </div>
</body>
</html>
