<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
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
        $projects = Project::paginate(8);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        $project = new Project;
        $project->fill($data);
        $project->save();
        return redirect()->route('admin.projects.show', compact('project'))->with('message-class', 'alert-success')->with('message', 'Progetto inserito correttamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all(), $project->id);
        $project->update($data);
        return redirect()->route('admin.projects.show', $project)->with('message-class', 'alert-success')->with('message', 'Progetto modificato correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message-class', 'alert-danger')->with('message', 'Progetto eliminato correttamente.');
    }



    //** Validation function*/ 

    private function validation($data, $id = null)
    {

        return Validator::make(
            $data,
            [
                'title' => 'required|unique:projects,title|string|max:50',
                'slug' => "nullable|string|max:50",
                "description" => "nullable|string",
                "github_url" => "nullable|string|max:150",
                "image_preview" => "nullable|string|max:150",
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo deve massimo di 50 caratteri',

                'slug.max' => 'Lo slug deve massimo di 50 caratteri',

                'description.string' => 'La descrizione deve essere una stringa',

                'github_url.string' => "L'url deve massimo di 150 caratteri",

                'image_preview.string' => "L'url deve massimo di 150 caratteri"
            ]
        )->validate();
    }
}
