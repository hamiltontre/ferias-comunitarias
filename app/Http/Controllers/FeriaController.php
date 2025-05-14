<?php

namespace App\Http\Controllers;

use App\Models\Feria;
use Illuminate\Http\Request;

class FeriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function attachEmprendedor(Request $request, Feria $feria)
{
    $feria->emprendedores()->attach($request->emprendedor_id);
    return back()->with('success', 'Emprendedor vinculado!');
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
    $request->validate([
        'nombre' => 'required|string|max:100',
        'fecha' => 'required|date',
        'lugar' => 'required|string',
    ]);

    Feria::create($request->all());
    return redirect()->route('ferias.index')->with('success', 'Feria creada!');
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
}
