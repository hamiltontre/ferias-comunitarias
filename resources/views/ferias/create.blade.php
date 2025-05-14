@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Feria</h1>
    
    <form action="{{ route('ferias.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        
        <div class="mb-3">
            <label for="lugar" class="form-label">Lugar</label>
            <input type="text" class="form-control" id="lugar" name="lugar" required>
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('ferias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection