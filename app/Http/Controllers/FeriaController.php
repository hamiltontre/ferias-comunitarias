<?php

namespace App\Http\Controllers;

use App\Models\Feria;
use App\Models\Emprendedor;
use Illuminate\Http\Request;

class FeriaController extends Controller
{
    public function index()
    {
        $ferias = Feria::all();
        return view('ferias.index', compact('ferias'));
    }

    public function create()
    {
        return view('ferias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha' => 'required|date',
            'lugar' => 'required',
            'descripcion' => 'required',
        ]);

        Feria::create($request->all());

        return redirect()->route('ferias.index')
            ->with('success', 'Feria creada exitosamente.');
    }

    public function show(Feria $feria)
    {
        $emprendedores = $feria->emprendedores;
        $allEmprendedores = Emprendedor::all();
        return view('ferias.show', compact('feria', 'emprendedores', 'allEmprendedores'));
    }

    public function edit(Feria $feria)
    {
        return view('ferias.edit', compact('feria'));
    }

    public function update(Request $request, Feria $feria)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha' => 'required|date',
            'lugar' => 'required',
            'descripcion' => 'required',
        ]);

        $feria->update($request->all());

        return redirect()->route('ferias.index')
            ->with('success', 'Feria actualizada exitosamente');
    }

    public function destroy(Feria $feria)
    {
        $feria->delete();

        return redirect()->route('ferias.index')
            ->with('success', 'Feria eliminada exitosamente');
    }

    public function attachEmprendedor(Request $request, Feria $feria)
    {
        $feria->emprendedores()->attach($request->emprendedor_id);
        return back()->with('success', 'Emprendedor agregado a la feria');
    }

    public function detachEmprendedor(Feria $feria, Emprendedor $emprendedor)
    {
        $feria->emprendedores()->detach($emprendedor->id);
        return back()->with('success', 'Emprendedor removido de la feria');
    }
}