@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Listado de Ferias</h1>
        <a href="{{ route('ferias.create') }}" class="btn btn-primary">Crear Nueva Feria</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ferias as $feria)
                <tr>
                    <td>{{ $feria->nombre }}</td>
                    <td>{{ $feria->fecha->format('d/m/Y') }}</td>
                    <td>{{ $feria->lugar }}</td>
                    <td>
                        <a href="{{ route('ferias.show', $feria->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('ferias.edit', $feria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ferias.destroy', $feria->id) }}" method="POST" style="display: inline;">
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