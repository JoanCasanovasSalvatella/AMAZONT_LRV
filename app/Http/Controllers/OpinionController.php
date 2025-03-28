<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Producto;

class OpinionController extends Controller
{
    public function crearOpinion(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'prod_id' => 'required|exists:productos,id', // Verifica que el producto exista
            'user_id' => 'required|exists:users,id', // Verifica que el usuario exista
            'comentario' => 'required|string', // Comentario obligatorio y no mayor a 1000 caracteres
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Crear la nueva opinión
        $opinion = Opinion::create([
            'prod_id' => $request->prod_id,
            'user_id' => $request->user_id,
            'comentario' => $request->comentario
        ]);

        // Verificar si la opinión se guardó correctamente
        if (!$opinion) {
            $data = [
                'message' => 'Error al guardar la opinión',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // Respuesta de éxito
        $data = [
            'opinion' => $opinion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function actualizarOpinion(Request $request, $id)
    {
        // Buscar la opinión por ID
        $opinion = Opinion::find($id);

        if (!$opinion) {
            $data = [
                'message' => 'Opinión no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Verificar si el usuario es el propietario de la opinión o tiene permisos para eliminarla
        // Puedes agregar aquí un middleware o validación según sea necesario. Ejemplo:
        // if ($opinion->user_id !== auth()->id()) {
        //     $data = [
        //         'message' => 'No tienes permiso para modificar esta opinión',
        //         'status' => 403
        //     ];
        //     return response()->json($data, 403);
        // }

        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'comentario' => 'required|string', // El comentario es obligatorio y no mayor a 1000 caracteres
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $opinion->comentario = $request->comentario;
        $opinion->save();

        // Respuesta de éxito
        $data = [
            'message' => 'Opinión actualizada',
            'opinion' => $opinion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function eliminarOpinion($id)
    {
        // Buscar la opinión por ID
        $opinion = Opinion::find($id);

        if (!$opinion) {
            $data = [
                'message' => 'Opinión no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Verificar si el usuario es el propietario de la opinión o tiene permisos para eliminarla
        // Puedes agregar aquí un middleware o validación según sea necesario. Ejemplo:
        // if ($opinion->user_id !== auth()->id()) {
        //     $data = [
        //         'message' => 'No tienes permiso para eliminar esta opinión',
        //         'status' => 403
        //     ];
        //     return response()->json($data, 403);
        // }

        // Eliminar la opinión
        $opinion->delete();

        // Respuesta de éxito
        $data = [
            'message' => 'Opinión eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function OpinionPorProducto($prod_id)
    {
        // Obtener todas las opiniones asociadas al producto
        $opiniones = Opinion::where('prod_id', $prod_id)->get();

        if ($opiniones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron opiniones para este producto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'opiniones' => $opiniones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function OpinionPorUsuario($user_id)
    {
        // Obtener todas las opiniones asociadas al usuario
        $opiniones = Opinion::where('user_id', $user_id)->get();

        if ($opiniones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron opiniones de este usuario',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'opiniones' => $opiniones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
