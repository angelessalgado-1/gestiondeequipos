<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function index(Equipo $equipo)
    {
        $jugadores = $equipo->jugadores;

        return view('jugadores.index', compact('equipo', 'jugadores'));
    }

    public function create(Equipo $equipo)
    {
        return view('jugadores.create', compact('equipo'));
    }

    public function store(Request $request, Equipo $equipo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:15',
            'dorsal' => 'required|integer',
            'valor_mercado' => 'required|numeric',
        ]);

        $validated['equipo_id'] = $equipo->id;

        Jugador::create($validated);

        return redirect()->route('equipos.jugadores', $equipo)->with('success', 'Jugador agregado correctamente.');
    }

    public function edit(Jugador $jugador)
    {
        return view('jugadores.edit', compact('jugador'));
    }

    public function update(Request $request, Jugador $jugador)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:15',
            'dorsal' => 'required|integer',
            'valor_mercado' => 'required|numeric',
        ]);

        $jugador->update($validated);

        return redirect()->route('equipos.jugadores', $jugador->equipo)->with('success', 'Jugador actualizado correctamente.');
    }

    public function destroy(Jugador $jugador)
    {
        $jugador->delete();
        return redirect()->route('equipos.jugadores', $jugador->equipo)->with('success', 'Jugador eliminado correctamente.');
    }
}
