<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 leading-tight">
            {{ __('Gestión de Equipos') }}
        </h2>
    </x-slot>

    <div class="container mt-4 mb-5">
        <a href="{{ route('equipos.create') }}" class="btn mb-4" style="background-color: #a855f7; color: white;">✨ Crear nuevo equipo</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            @foreach($equipos as $equipo)
                <div class="col-lg-3 col-md-4 d-flex mb-4">
                    <div class="card w-100 d-flex flex-column shadow" style="max-height: 600px; border: 1px solid #e9d5ff;">
                        @if($equipo->imagen)
                            <img src="{{ asset('storage/' . $equipo->imagen) }}" class="card-img-top rounded-top" alt="Imagen del equipo" style="height: 220px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300?text=Sin+Imagen" class="card-img-top rounded-top" alt="No has subido una imagen del equipo" style="height: 220px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h1 class="card-title" style="font-size: 26px; color: #7c3aed;">{{ $equipo->nombre }}</h1>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($equipo->descripcion, 70) }}</p>
                            <p class="card-text"><strong>🌸 Fundado en:</strong> {{ $equipo->fundacion }}</p>

                            <a href="{{ route('equipos.jugadores', $equipo) }}" class="btn btn-light border mb-2 w-100" style="color: #7c3aed;">Ver jugadores</a>

                            <div class="mt-auto">
                                <a href="{{ route('equipos.edit', $equipo) }}" class="btn mb-2 w-100" style="background-color: #c084fc; color: white;">Editar ✏️</a>

                                <button type="button" class="btn w-100" style="background-color: #e9d5ff; color: #7c3aed;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $equipo->id }}">
                                    Eliminar
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="deleteModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #f3e8ff;">
                                        <h5 class="modal-title">¿Eliminar equipo?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás segura de eliminar <strong>“{{ $equipo->nombre }}”</strong>? Esta acción no se puede deshacer 🥺
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('equipos.destroy', $equipo) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" style="background-color: #d8b4fe; color: white;">
                                                Sí, eliminarlo
                                            </button>                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $equipos->links() }}
        </div>
    </div>
</x-app-layout>
