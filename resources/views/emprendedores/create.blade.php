@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Emprendedor</h1>
        
        <form action="{{ route('emprendedores.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
                @error('telefono')  
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
            </div>
            
            <div class="mb-3">
                <label for="rubro" class="form-label">Rubro</label>
                <input type="text" class="form-control" id="rubro" name="rubro" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('emprendedores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection