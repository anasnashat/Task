<html>

<head></head>

<body>

    <form method="post" action="{{ route('task.store') }}" enctype="multipart/form-data">
        @csrf
        <input name="title" type="text">
        <input type="file" id="images" name="images[]" accept="image/*" multiple required>
        <input type="submit">
    </form>

</body>
</html>
