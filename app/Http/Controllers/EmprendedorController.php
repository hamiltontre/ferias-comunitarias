<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Models\Feria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmprendedorController extends Controller
{
    public function index()
    {
        $emprendedores = Emprendedor::with('ferias')->get();
        return view('emprendedores.index', compact('emprendedores'));
    }

    public function create()
    {
        $ferias = Feria::all();
        return view('emprendedores.create', compact('ferias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|min:8|max:15|regex:/^[0-9+]+$/',
            'rubro' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'ferias' => 'nullable|array',
            'ferias.*' => 'exists:ferias,id'
        ]);

        DB::transaction(function () use ($request) {
            $emprendedor = Emprendedor::create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,  // Campo agregado
                'rubro' => $request->rubro,       // Campo agregado
                'descripcion' => $request->descripcion,
            ]);

            if ($request->has('ferias')) {
                $emprendedor->ferias()->sync($request->ferias);
            }
        });

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedor creado exitosamente');
    }

    public function show(Emprendedor $emprendedor)
    {
        return view('emprendedores.show', compact('emprendedor'));
    }

    public function edit(Emprendedor $emprendedor)
    {
        $ferias = Feria::all();
        return view('emprendedores.edit', compact('emprendedor', 'ferias'));
    }

    public function update(Request $request, Emprendedor $emprendedor)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|min:8|max:15|regex:/^[0-9+]+$/',
            'rubro' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'ferias' => 'nullable|array',
            'ferias.*' => 'exists:ferias,id'
        ]);

        $emprendedor->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,  // Campo agregado
            'rubro' => $request->rubro,       // Campo agregado
            'descripcion' => $request->descripcion,
        ]);

        $emprendedor->ferias()->sync($request->ferias ?? []);

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedor actualizado exitosamente');
    }

    public function destroy(Request $request, Emprendedor $emprendedor)
    {
        // Verificar si es el último emprendedor en alguna feria
        $feriasAEliminar = $emprendedor->ferias()
            ->whereHas('emprendedores', function($query) use ($emprendedor) {
                $query->where('emprendedores.id', '!=', $emprendedor->id);
            }, '=', 0)
            ->get();

        // Si hay ferias que se eliminarán y no se ha confirmado
        if ($feriasAEliminar->isNotEmpty() && !$request->has('confirmar')) {
            $nombresFeria = $feriasAEliminar->pluck('nombre')->implode(', ');
            
            return back()->with('confirmar_eliminar', [
                'message' => "Este emprendedor es el único participante en las siguientes ferias: $nombresFeria. Si lo eliminas, estas ferias también serán eliminadas.",
                'emprendedor_id' => $emprendedor->id
            ]);
        }

        DB::transaction(function () use ($emprendedor, $feriasAEliminar) {
            // Eliminar las ferias que quedarían sin emprendedores
            foreach ($feriasAEliminar as $feria) {
                $feria->delete();
            }
            
            // Eliminar el emprendedor
            $emprendedor->delete();
        });

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedor eliminado exitosamente' . 
                  ($feriasAEliminar->isNotEmpty() ? ' junto con las ferias asociadas' : ''));
    }
}