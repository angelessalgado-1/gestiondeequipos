<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 leading-tight">
            Jugadores del equipo {{ $equipo->nombre }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="mb-4 d-flex">
            <a href="{{ route('dashboard') }}" class="btn btn-light border me-2" style="color: #7c3aed;">← Regresar</a>
            <button class="btn" style="background-color: #c084fc; color: white;" data-bs-toggle="modal" data-bs-target="#agregarJugadorModal">➕ Agregar jugador</button>
        </div>

        @if($jugadores->isEmpty())
            <div class="alert alert-info">No hay jugadores registrados para este equipo.</div>
        @else
            <div class="row">
                @foreach($jugadores as $jugador)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #7c3aed;">{{ $jugador->nombre }}</h5>
                                <p class="card-text"><strong>Edad:</strong> {{ $jugador->edad }} años</p>
                                <p class="card-text"><strong>Dorsal preferido:</strong> #{{ $jugador->dorsal }}</p>
                                <p class="card-text"><strong>Valor en el mercado:</strong> L {{ number_format($jugador->valor_mercado, 2) }}</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm" style="background-color: #d8b4fe; color: white;" data-bs-toggle="modal" data-bs-target="#editarJugadorModal{{ $jugador->id }}">✏️ Editar</button>
                                    <button class="btn btn-sm" style="background-color: #e9d5ff; color: #7c3aed;" data-bs-toggle="modal" data-bs-target="#eliminarJugadorModal{{ $jugador->id }}">🗑️ Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editarJugadorModal{{ $jugador->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('jugadores.update', $jugador) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header" style="background-color: #f3e8ff;">
                                        <h5 class="modal-title">Editar jugador</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $jugador->nombre }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Edad</label>
                                            <input type="number" name="edad" class="form-control" value="{{ $jugador->edad }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Dorsal preferido</label>
                                            <input type="number" name="dorsal" class="form-control" value="{{ $jugador->dorsal }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Valor de mercado (Lempiras)</label>
                                            <input type="number" name="valor_mercado" class="form-control" value="{{ $jugador->valor_mercado }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn" style="background-color: #a78bfa; color: white;">Actualizar jugador</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="eliminarJugadorModal{{ $jugador->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #f3e8ff;">
                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás segura de eliminar a <strong>{{ $jugador->nombre }}</strong>? Esta acción no se puede deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('jugadores.destroy', $jugador) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background-color: #d8b4fe; color: white;">Eliminar jugador</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="modal fade" id="agregarJugadorModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('jugadores.store', $equipo) }}" method="POST">
                    @csrf
                    <div class="modal-header" style="background-color: #f3e8ff;">
                        <h5 class="modal-title">Agregar jugador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Edad</label>
                            <input type="number" name="edad" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dorsal preferido</label>
                            <input type="number" name="dorsal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valor de mercado (Lempiras)</label>
                            <input type="number" name="valor_mercado" class="form-control" required>
                        </div>
                        <input type="hidden" name="equipo_id" value="{{ $equipo->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn" style="background-color: #a78bfa; color: white;">Guardar jugador</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
