<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{

    public function index()
    {
        $equipos = Equipo::where('user_id', Auth::id())->paginate(8);
        return view('dashboard', compact('equipos'));
    }



    public function create()
    {
        return view('equipos.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fundacion' => 'required|integer',
            'descripcion' => 'required|string',
        ]);

        $equipo = new Equipo();
        $equipo->nombre = $validated['nombre'];
        $equipo->fundacion = $validated['fundacion'];
        $equipo->descripcion = $validated['descripcion'];
        $equipo->user_id = Auth::id();

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('equipos', 'public');
            $equipo->imagen = $imagePath;
        }

        $equipo->save();

        return redirect()->route('dashboard')->with('success', 'Equipo creado correctamente.');
    }


    public function edit(Equipo $equipo)
    {
        if ($equipo->user_id !== Auth::id()) {
            return redirect()->route('equipos.index')->with('error', 'No esta permitido editar este equipo.');
        }

        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        if ($equipo->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'No esta permitido  actualizar este equipo.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fundacion' => 'required|integer',
            'descripcion' => 'required|string',
        ]);

        $equipo->nombre = $validated['nombre'];
        $equipo->fundacion = $validated['fundacion'];
        $equipo->descripcion = $validated['descripcion'];

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('equipos', 'public');
            $equipo->imagen = $imagePath;
        }

        $equipo->save();

        return redirect()->route('dashboard')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        if ($equipo->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para eliminar este equipo.');
        }

        $equipo->delete();

        return redirect()->route('dashboard')->with('success', 'Equipo eliminado correctamente.');
    }

    private function middleware(string $string)
    {
    }
}

