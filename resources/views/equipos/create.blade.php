<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 leading-tight">
            Crear un nuevo equipo
        </h2>
    </x-slot>

    <div class="container mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-light border mb-3" style="color: #7c3aed;">← Volver a mis equipos</a>
        <form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del equipo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="fundacion" class="form-label">Año de fundación</label>
                <input type="number" class="form-control" id="fundacion" name="fundacion" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>

            <button type="submit" class="btn" style="background-color: #a78bfa; color: white;">Crear equipo</button>
        </form>
    </div>
</x-app-layout>
