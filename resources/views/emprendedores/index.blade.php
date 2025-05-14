@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Listado de Emprendedores</h1>
        <a href="{{ route('emprendedores.create') }}" class="btn btn-primary">Crear Nuevo Emprendedor</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Rubro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emprendedores as $emprendedor)
                <tr>
                    <td>{{ $emprendedor->nombre }}</td>
                    <td>{{ $emprendedor->telefono }}</td>
                    <td>{{ $emprendedor->rubro }}</td>
                    <td>
                        <a href="{{ route('emprendedores.show', $emprendedor->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('emprendedores.edit', $emprendedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('emprendedores.destroy', $emprendedor->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection