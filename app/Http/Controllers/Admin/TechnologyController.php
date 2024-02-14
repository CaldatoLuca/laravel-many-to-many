<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index_tech', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create_tech');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $data = $request->validated();

        $technology = new Technology();
        $technology->fill($data);

        $technology->slug = Str::of($technology->title)->slug('-');


        $technology->save();

        // Memorizza il messaggio di notifica nella sessione
        Session::push('dashboard_notifications', "Technology '$technology->title' created");

        return redirect()->route('admin.technologies.index')->with('message_create', "Technology '$technology->title' created");
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
    public function destroy(Technology $technology)
    {
        $technology_title = $technology->title;

        // Elimina la Technology (e i record associati nella tabella di relazione many-to-many verranno eliminati automaticamente)
        $technology->delete();

        // Memorizza il messaggio di notifica nella sessione
        Session::push('dashboard_notifications', "Technology '$technology_title' eliminated");

        return redirect()->route('admin.technologies.index')->with('message_delete', "Technology '$technology_title' eliminated");
    }
}
