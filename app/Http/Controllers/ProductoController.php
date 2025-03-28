<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function mostrarProduct() {
        $productos = Producto::all();

        if ($productos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron productos',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'productos' => $productos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function mostrarUnSoloProduct($id) {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function crearProduct(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'oferta' => 'required',
            'imagen' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'precioAnterior' => 'required|numeric',
            'cantidad' => 'required|integer|min:1',
            'cat_id' => 'required|exists:categorias,id',
            'user_id' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto = Producto::create($request->all());

        if (!$producto) {
            $data = [
                'message' => 'Error al crear el producto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'producto' => $producto,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function modificarProduct(Request $request, $id) {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'oferta' => 'required',
            'imagen' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'precioAnterior' => 'required|numeric',
            'cantidad' => 'required|integer|min:1',
            'cat_id' => 'required|exists:categorias,id',
            'user_id' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto->nombre = $request->nombre;
        $producto->oferta = $request->oferta;
        $producto->imagen = $request->imagen;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->precioAnterior = $request->precioAnterior;
        $producto->cantidad = $request->cantidad;
        $producto->cat_id = $request->cat_id;
        $producto->user_id = $request->user_id;
        $producto->save();

        $data = [
            'message' => 'Producto actualizado',
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function modificarCampoProduct(Request $request, $id) {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:255',
            'oferta' => 'boolean',
            'imagen' => 'string',
            'descripcion' => 'string',
            'precio' => 'numeric',
            'precioAnterior' => 'numeric',
            'cantidad' => 'integer|min:1',
            'cat_id' => 'exists:categorias,id',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $producto->nombre = $request->nombre;
        }

        if ($request->has('oferta')) {
            $producto->oferta = $request->oferta;
        }

        if ($request->has('imagen')) {
            $producto->imagen = $request->imagen;
        }

        if ($request->has('descripcion')) {
            $producto->descripcion = $request->descripcion;
        }

        if ($request->has('precio')) {
            $producto->precio = $request->precio;
        }

        if ($request->has('precioAnterior')) {
            $producto->precioAnterior = $request->precioAnterior;
        }

        if ($request->has('cantidad')) {
            $producto->cantidad = $request->cantidad;
        }

        if ($request->has('cat_id')) {
            $producto->cat_id = $request->cat_id;
        }

        if ($request->has('user_id')) {
            $producto->user_id = $request->user_id;
        }

        $producto->save();

        $data = [
            'message' => 'Producto actualizado',
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function eliminarProduct($id) {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $producto->delete();

        $data = [
            'message' => 'Producto eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
