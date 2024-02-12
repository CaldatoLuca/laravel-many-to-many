<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $types = Type::all();

        return view('admin.projects.index', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();

        $project->fill($data);
        //gestisco io slug e immagine - messi in guardede nel model
        //slug diventa il titolo sluggato
        //thumb salva il dato che prende dal server, lo salva in uploads e restituisce la path
        $project->slug = Str::of($project->title)->slug('-');
        if (isset($data['thumb'])) {
            $project->thumb = Storage::put('uploads', $data['thumb']);
        }
        $project->save();

        return redirect()->route('admin.projects.index')->with('message_create', "Project '$project->title' created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();

        return view('admin.projects.edit',  compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        //ho messo slug in guarded e lo gestisco io, salvo un nuovo slug cosi cambia se il titolo cambia
        $project->slug = Str::of($data['title'])->slug('-');

        //gestisco i casi in cui ho img e ne carico una diversa
        if (array_key_exists('thumb', $data)) {
            if ($project->thumb) {
                //cancella l'immagine vecchia
                Storage::delete($project->thumb);
            }
            $project->thumb = Storage::put('uploads', $data['thumb']);
        }



        //aggiorna tutto tranne slug, ci ho pensato io
        $project->update($data);

        $project_title = $project->title;

        return redirect()->route('admin.projects.show', $project)->with('message_update', "Project '$project_title' modified");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project_title = $project->title;

        //cancello immagine se c'è
        if ($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('message_delete', "Project '$project_title' eliminated");
    }
}
