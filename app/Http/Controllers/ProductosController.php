<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function index(){
        return view('productos.index');
    }
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'imagen_url' => 'required|image'
        ]);

        //obtener nombre de la imagen
        $nombreImagen = time() . '_' . $request->imagen_url->getClientOriginalName();
        //obtener ruta
        $ruta = $request->imagen_url->storeAs('public/imagenes/productos', $nombreImagen);
        $url = Storage::url($ruta);

        Productos::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen_url' => $url
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }
}
