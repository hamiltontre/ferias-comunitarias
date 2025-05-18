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
                    <td>{{ $feria->fecha }}</td>
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

    @if(session('confirmar_eliminar_feria'))
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">¡Atención!</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('confirmar_eliminar_feria')['message'] }}</p>
                    <p>¿Deseas continuar con la eliminación?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('ferias.destroy', session('confirmar_eliminar_feria')['feria_id']) }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="confirmar" value="1">
                        <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Confirmar Eliminación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
<script>
function cerrarModal() {
    const modal = document.querySelector('.modal');
    if (modal) modal.style.display = 'none';
}
</script>
@endpush