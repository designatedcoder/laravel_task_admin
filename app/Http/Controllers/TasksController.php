<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tasks = (new Task)->getAll();
        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Task::create([
            'description' => $request->description,
            'command' => $request->command,
            'expression' => $request->expression ?? '* * * * *',
            'notification_email' => $request->notification_email,
            'dont_overlap' => $request->dont_overlap,
            'run_in_maintenance' => $request->run_in_maintenance,
        ]);
        return to_route('tasks.index')->with('status', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) {
        return Inertia::render('Tasks/Show', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task) {
        $task->update([
            'description' => $request->description,
            'command' => $request->command,
            'expression' => $request->expression ?? '* * * * *',
            'notification_email' => $request->notification_email,
            'dont_overlap' => $request->dont_overlap,
            'run_in_maintenance' => $request->run_in_maintenance,
        ]);
        return to_route('tasks.index')->with('status', 'Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) {
        $task->delete();
        return to_route('tasks.index')->with('status', 'Task Deleted');
    }

    /**
     * Toggles a task active state
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function toggle(Task $task) {
        $task->is_active = !$task->is_active;
        $task->save();
        return to_route('tasks.index')->with('status', 'Task Updated');
    }
}
