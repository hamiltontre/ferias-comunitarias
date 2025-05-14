@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Feria: {{ $feria->nombre }}</h1>
        <div>
            <a href="{{ route('ferias.edit', $feria->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('ferias.destroy', $feria->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Fecha:</strong> {{ $feria->fecha->format('d/m/Y') }}</p>
            <p><strong>Lugar:</strong> {{ $feria->lugar }}</p>
            <p><strong>Descripción:</strong> {{ $feria->descripcion }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Emprendedores participantes</h5>
            <form action="{{ route('ferias.attachEmprendedor', $feria->id) }}" method="POST" class="d-flex">
                @csrf
                <select name="emprendedor_id" class="form-select me-2" required>
                    <option value="">Seleccionar emprendedor</option>
                    @foreach($allEmprendedores as $emprendedor)
                        <option value="{{ $emprendedor->id }}">{{ $emprendedor->nombre }} ({{ $emprendedor->rubro }})</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Agregar</button>
            </form>
        </div>
        <div class="card-body">
            @if($emprendedores->isEmpty())
                <p>No hay emprendedores registrados en esta feria.</p>
            @else
                <table class="table">
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
                                    <form action="{{ route('ferias.detachEmprendedor', ['feria' => $feria->id, 'emprendedor' => $emprendedor->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Quitar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection