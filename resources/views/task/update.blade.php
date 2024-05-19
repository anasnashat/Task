<html>

<head></head>

<body>

<form method="post" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input name="title" type="text" value="{{ $task->title }}">
    @foreach($task->image as $image)
        <img width="10" height="10" src="{{ asset('storage/images/'. $task->title.'/' . $image->image) }}" alt="Image">
    @endforeach
    <input type="file" id="images" name="images[]" accept="image/*" multiple>
    <input type="submit" value="Update">
</form>
</body>
</html>
