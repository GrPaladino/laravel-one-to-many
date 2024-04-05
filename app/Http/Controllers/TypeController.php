<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $types = Type::paginate(10);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Type $type)
    {
        return view('admin.types.form', compact('type'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        // $request->validated();

        $data = $request->all();
        $type = new Type;
        $type->fill($data);

        $type->save();
        return redirect()->route('admin.types.show', compact('type'))->with('message-class', 'alert-success')->with('message', 'Tipologia inserita correttamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        return view('admin.types.form', compact('type'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function update(Request $request, Type $type)
    {
        // $request->validated();
        $data = $request->all();
        $type->update($data);
        return redirect()->route('admin.types.show', $type)->with('message-class', 'alert-success')->with('message', 'Tipologia modificata correttamente.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     */
    public function destroy(Type $type)
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            if ($project->type_id == $type->id) {
                $project->delete();
            }
        }

        $type->delete();
        return redirect()->route('admin.projects.index')->with('message-class', 'alert-danger')->with('message', 'Progetto eliminato correttamente.');

    }
}