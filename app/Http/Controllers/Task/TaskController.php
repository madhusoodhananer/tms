<?php

namespace App\Http\Controllers\Task;

use App\Enum\Task\TaskPriorityEnum;
use App\Enum\Task\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::get();
        return response()->json([$tasks,
            'Successfully retrieved tasks',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:tasks,title',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => ['required', new Enum(TaskStatusEnum::class)],
            'priority' => ['required', new Enum(TaskPriorityEnum::class)],
            'project_id' => 'required|exists:projects,id',
            'start_date' => 'required|date_format:Y-m-d',
            'due_date' => 'nullable|date_format:Y-m-d|after:start_date',
            'completed_date' => 'nullable|date_format:Y-m-d|after:start_date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'status' => $request->status,
            'project_id' => $request->project_id,
            'priority' => $request->priority,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'completed_date' => $request->completed_date,
        ]);

        return response()->json([$task,
            'Successfully created task',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return response()->json([$task,
            'Successfully retrieved task',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => [
            'required',
            'string',
            Rule::unique('tasks', 'title')->ignore($id),
        ],
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => ['required', new Enum(TaskStatusEnum::class)],
            'priority' => ['required', new Enum(TaskPriorityEnum::class)],
            'project_id' => 'required|exists:projects,id',
            'start_date' => 'required|date_format:Y-m-d',
            'due_date' => 'nullable|date_format:Y-m-d|after:start_date',
            'completed_date' => 'nullable|date_format:Y-m-d|after:start_date',
        ]);


        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'status' => $request->status,
            'project_id' => $request->project_id,
            'priority' => $request->priority,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'completed_date' => $request->completed_date,
        ]);

        return response()->json([$task,
            'Successfully updated task',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json([[],
            'Successfully deleted task',
        ]);
    }
}
