@foreach ($tasks as $task)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">{{ $task->title }}</div>
            <div class="card-body">
                    <div class="row">
                        @foreach ($task->image as $image)
                            <div class="col-md-4 mb-2">
                                <img width="20" height="20" src="{{ asset('storage/images/' . $task->title . '/' . $image->image) }}" class="img-fluid" alt="Image">
                            </div>
                        @endforeach
                    </div>
                <a href="{{ route('task.edit',$task->id) }}"> edit</a>
                <form method="post" action="{{ route('task.destroy', $task->id)}}">
                   @method('delete')
                    @csrf
                    <input type="submit" value="delete">
                </form>
            </div>
        </div>
    </div>
@endforeach
