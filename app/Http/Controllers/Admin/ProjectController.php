<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);

        if (Auth::user()->role != 'admin') {
            $projects->where('user_id', Auth::id());
        }


        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreProjectRequest $request)
    {
        $request->validated();

        $data = $request->all();
        $project = new Project;
        $project->fill($data);
        $project->user_id = Auth::id();
        $project->save();

        return redirect()->route('admin.projects.show', compact('project'))->with('message-class', 'alert-success')->with('message', 'Progetto inserito correttamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function show(Project $project)
    {

        if ($project->user_id != Auth::id())
            abort(403);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function edit(Project $project)
    {
        if ($project->user_id != Auth::id())
            abort(403);

        $types = Type::all();
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ($project->user_id != Auth::id())
            abort(403);

        $request->validated();
        $data = $request->all();
        $project->update($data);
        return redirect()->route('admin.projects.show', $project)->with('message-class', 'alert-success')->with('message', 'Progetto modificato correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function destroy(Project $project)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message-class', 'alert-danger')->with('message', 'Progetto eliminato correttamente.');
    }
}
