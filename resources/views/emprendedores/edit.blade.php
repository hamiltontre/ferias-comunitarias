@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h2 class="mb-0">Editar Emprendedor: {{ $emprendedor->nombre }}</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('emprendedores.update', $emprendedor->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="font-weight-bold">Nombre completo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" 
                                   value="{{ old('nombre', $emprendedor->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono" class="font-weight-bold">Teléfono</label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                   id="telefono" name="telefono" 
                                   value="{{ old('telefono', $emprendedor->telefono) }}" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                  <label for="rubro" class="font-weight-bold">Rubro/Actividad</label>
    <input type="text" 
           class="form-control @error('rubro') is-invalid @enderror" 
           id="rubro" 
           name="rubro" 
           value="{{ old('rubro', $emprendedor->rubro) }}"
           required>
    @error('rubro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Ferias Asociadas</label>
                    @if($ferias->count() > 0)
                        <div class="row">
                            @foreach($ferias as $feria)
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="feria_{{ $feria->id }}" 
                                           name="ferias[]" 
                                           value="{{ $feria->id }}"
                                           {{ $emprendedor->ferias->contains($feria->id) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="feria_{{ $feria->id }}">
                                        {{ $feria->nombre }} ({{ $feria->fecha->format('d/m/Y') }})
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">No hay ferias registradas</div>
                    @endif
                </div>

                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('emprendedores.show', $emprendedor->id) }}" 
                       class="btn btn-outline-secondary">
                       <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validación básica del formulario
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const telefono = document.getElementById('telefono').value;
            if (!/^[0-9+]{8,15}$/.test(telefono)) {
                e.preventDefault();
                alert('El teléfono debe contener solo números y tener entre 8-15 caracteres');
            }
        });
    });
</script>
@endsection