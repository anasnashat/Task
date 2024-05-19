<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskRequest;
use App\Models\Image;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks =Task::all();
        return view('task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validatedData = $request->validated();
        $images = $validatedData['images'];

        $task = Task::create(['title' => $validatedData['title']]);

        foreach ($images as $image) {
            $fileName = $validatedData['title'] . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/' . $validatedData['title'], $fileName, 'public');

            Image::create([
                              'task_id' => $task->id,
                              'image' => $fileName,
                          ]);
        }

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $task->with('image');
        return view('task.update', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(taskRequest $request, Task $task)
    {
        $validatedData = $request->validated();
        if ($task->title !== $validatedData['title']) {
            Storage::disk('public')->move('images/' . $task->title, 'images/' . $validatedData['title']);

            $task->update(['title' => $validatedData['title']]);
        }


        if ($request->hasFile('images')){
            $images = $validatedData['images'];
            foreach ($images as $image) {
                $fileName = $validatedData['title'] . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/' . $validatedData['title'], $fileName, 'public');

                Image::create([
                                  'task_id' => $task->id,
                                  'image' => $fileName,
                              ]);
            }
        }


        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Storage::disk('public')->deleteDirectory('images/'.$task->title);
        $task->delete();
    }
}
