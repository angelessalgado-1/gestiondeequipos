<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 leading-tight">
            Editar equipo
        </h2>
    </x-slot>

    <div class="container mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-light border mb-3" style="color: #7c3aed;">← Volver a mis equipos</a>

        <form action="{{ route('equipos.update', $equipo) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $equipo->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="fundacion">Año de Fundación</label>
                <input type="number" name="fundacion" class="form-control" id="fundacion" value="{{ $equipo->fundacion }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3" required>{{ $equipo->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control" id="imagen">
            </div>

            <button type="submit" class="btn" style="background-color: #a78bfa; color: white;">Actualizar</button>
        </form>
    </div>
</x-app-layout>
