<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskTimeTracker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskTimeTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function startTaskTimer(Request $request, $id)
    {
        $request->validate([
            'started_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $task = Task::findOrFail($id);

        $runningTimerExit = TaskTimeTracker::where('task_id', $task->id)
            ->whereNull('ended_at')->exists();
        if($runningTimerExit){
            throw ValidationException::withMessages([
                'task_id' => ['A timer is already running for this task. Please stop it before starting a new one.']
            ]);
        }

        $taskTimeTracker = TaskTimeTracker::create([
            'task_id' => $id,
            'assignee' => $task->assigned_to,
            'started_at' => $request->started_at,
        ]);

        return response()->json([$taskTimeTracker,
            'Task time tracker started',
        ]);
    }

    public function stopTaskTimer(Request $request, $id)
    {
        $request->validate([
            'ended_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $task = Task::findOrFail($id);

        $runningTimer = TaskTimeTracker::where('task_id', $task->id)
            ->whereNull('ended_at')
            ->first();

        $startTime = Carbon::parse($runningTimer->started_at);
        $endTime = Carbon::parse($request->ended_at);
        if ($endTime->lessThanOrEqualTo($startTime)) {
            throw ValidationException::withMessages([
                'ended_at' => ['The end time must be after the start time.']
            ]);
        }

        if(!$runningTimer){
            throw ValidationException::withMessages([
                'task_id' => ['Timer is not running for this task.']
            ]);
        }

        $startTime = Carbon::parse($runningTimer->started_at);
        $endTime = Carbon::parse($request->ended_at);
        $durationInSeconds = $endTime->diffInSeconds($startTime);

        $taskTimeTracker = TaskTimeTracker::where('task_id', $id)
            ->update([
            'ended_at' => $request->ended_at,
            'duration' => -($durationInSeconds),
        ]);

        return response()->json([$taskTimeTracker,
            'Task time tracker stoped',
        ]);
    }


    public function taskTimerDuration(Request $request, $id)
    {
        $timer = TaskTimeTracker::where('task_id', $id)->get();

        return response()->json([$timer,
            'Task time retrieved.',
        ]);
    }
}
