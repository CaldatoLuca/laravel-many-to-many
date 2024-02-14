<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index_types', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $data = $request->validated();

        $type = new Type();
        $type->fill($data);

        $type->slug = Str::of($type->title)->slug('-');


        $type->save();

        // Memorizza il messaggio di notifica nella sessione
        Session::push('dashboard_notifications', "Type '$type->title' created");

        return redirect()->route('admin.types.index')->with('message_create', "Type '$type->title' created");
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
    public function destroy(Type $type)
    {
        $type_title = $type->title;

        $type->delete();

        // Memorizza il messaggio di notifica nella sessione
        Session::push('dashboard_notifications', "Type '$type_title' eliminated");

        return redirect()->route('admin.types.index')->with('message_delete', "Type '$type_title' eliminated");
    }
}
