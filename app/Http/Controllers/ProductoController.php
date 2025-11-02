<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    // Mostrar todos los productos del usuario con su categoría
    public function index()
    {
        $userId = Auth::id();
        $productos = Producto::where('user_id', $userId)
                            ->with('categoria')
                            ->get();

        $categorias = Categoria::where('user_id', $userId)->get();

        return view('productos.index', compact('productos', 'categorias'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('productos.create', compact('categorias'));
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario para editar producto
    public function edit(Producto $producto)
    {
        if ($producto->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este producto.');
        }

        // Obtener todos los productos del usuario para calcular índice
        $productos = Producto::where('user_id', Auth::id())
                            ->orderBy('id')
                            ->get();

        // Calcular el índice del producto en la lista (para mostrar como #1, #2, etc.)
        $index = $productos->search(function($p) use ($producto) {
            return $p->id === $producto->id;
        });

        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('productos.edit', compact('producto', 'categorias', 'index'));
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        if ($producto->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este producto.');
        }

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        if ($producto->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este producto.');
        }

        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
