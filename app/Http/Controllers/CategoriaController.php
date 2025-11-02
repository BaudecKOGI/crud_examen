<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        // Mostrar solo categorías del usuario actual
        $categorias = Categoria::where('user_id', Auth::id())->with('productos')->get();

        // También pasamos los productos del usuario para la estadística
        $productos = \App\Models\Producto::where('user_id', Auth::id())->get();

        return view('categorias.index', compact('categorias', 'productos'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado' => 'required|in:activo,inactivo'
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('categorias', 'public');
        }

        $data['user_id'] = Auth::id();

        Categoria::create($data);
        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        $this->authorizeCategoria($categoria);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $this->authorizeCategoria($categoria);

        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado' => 'required|in:activo,inactivo'
        ]);

        if ($request->hasFile('imagen')) {
            if ($categoria->imagen && Storage::disk('public')->exists($categoria->imagen)) {
                Storage::disk('public')->delete($categoria->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('categorias', 'public');
        }

        $categoria->update($data);
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $this->authorizeCategoria($categoria);

        if ($categoria->imagen && Storage::disk('public')->exists($categoria->imagen)) {
            Storage::disk('public')->delete($categoria->imagen);
        }

        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }

    protected function authorizeCategoria(Categoria $categoria)
    {
        if ($categoria->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
    }
}
