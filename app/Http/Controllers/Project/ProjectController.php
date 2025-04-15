<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\ProjectStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();
        return response()->json([$projects,
            'Successfully retrieved projects',
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
            'owner' => 'required|exists:users,id',
            'title' => 'required|string|unique:projects,title',
            'description' => 'required|string',
            'status' => ['required', new Enum(ProjectStatusEnum::class)],
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after:start_date',

        ]);

        $project = Project::create([
            'owner' => $request->owner,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([$project,
            'Successfully created project',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return response()->json([$project,
            'Successfully retrieved project',
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
            'owner' => 'required|exists:users,id',
            'title' => 'required|string|unique:projects,title,' . $id,
            'description' => 'required|string',
            'status' => ['required', new Enum(ProjectStatusEnum::class)],
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after:start_date',

        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'owner' => $request->owner,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([$project,
            'Successfully updated project',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json([[],
            'Successfully deleted project',
        ]);
    }
}
