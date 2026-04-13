<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $tasks=Task::orderBy('created_at','desc')->get();
       return view('tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'nullable|max:1000',
        ]);

        Task::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'completed'=>false,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>['required','max:255'],
            'description'=>['nullable','max:1000'],
        ]);
        $task->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'completed'=>$request->has('completed'),
        ]);
        return redirect()->route('tasks.index')->with('success','¡Tarea actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Tarea Elimianda!');
    }
}
