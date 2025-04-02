<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function mostrarCategory() {
        $categorias = Categoria::all();

        if ($categorias->isEmpty()) {
            $data = [
                'message' => 'No se encontraron categorias',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'categorias' => $categorias,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function mostrarUnSoloCategory($id) {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            $data = [
                'message' => 'Categoria no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'categoria' => $categoria,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function crearCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'imagen' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen
        ]);

        if (!$categoria) {
            $data = [
                'message' => 'Error al crear la categoría',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'categoria' => $categoria,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function modificarCategory(Request $request, $id) {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'imagen' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $categoria->nombre = $request->nombre;
        $categoria->imagen = $request->imagen;
        $categoria->save();

        $data = [
            'message' => 'Categoría actualizada',
            'categoria' => $categoria,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function modificarCampoCategory(Request $request, $id) {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:255|unique:categorias,nombre',
            'imagen' => 'string'
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
            $categoria->nombre = $request->nombre;
        }

        if ($request->has('imagen')) {
            $categoria->imagen = $request->imagen;
        }

        $categoria->save();

        $data = [
            'message' => 'Categoría actualizada',
            'categoria' => $categoria,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function eliminarCategory($id) {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            $data = [
                'message' => 'Categoria no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $categoria->delete();

        $data = [
            'message' => 'Categoria eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
