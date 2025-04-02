<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Valoracion;
use App\Models\User;
use App\Models\Producto;

class ValoracionController extends Controller
{
    public function crearValoracion(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'prod_id' => 'required|exists:productos,id', // Verifica que el producto exista
            'user_id' => 'required|exists:users,id', // Verifica que el usuario exista
            'puntuacion' => 'required|integer|min:1|max:5', // Puntuación obligatoria entre 1 y 5
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Crear la nueva valoración
        $valoracion = Valoracion::create([
            'prod_id' => $request->prod_id,
            'user_id' => $request->user_id,
            'puntuacion' => $request->puntuacion
        ]);

        // Verificar si la valoración se guardó correctamente
        if (!$valoracion) {
            $data = [
                'message' => 'Error al guardar la valoración',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // Respuesta de éxito
        $data = [
            'valoracion' => $valoracion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function actualizarValoracion(Request $request, $id)
    {
        // Buscar la valoración por ID
        $valoracion = Valoracion::find($id);

        if (!$valoracion) {
            $data = [
                'message' => 'Valoración no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Verificar si el usuario es el propietario de la valoración
        // Aquí puedes verificar que el usuario logueado sea el mismo que creó la valoración
        //if ($valoracion->user_id !== auth()->id()) {
        //    $data = [
        //        'message' => 'No tienes permiso para modificar esta valoración',
        //        'status' => 403
        //    ];
        //    return response()->json($data, 403);
        //}

        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'puntuacion' => 'required|integer|min:1|max:5', // Puntuación obligatoria entre 1 y 5
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualizar la valoración
        $valoracion->puntuacion = $request->puntuacion;
        $valoracion->save();

        // Respuesta de éxito
        $data = [
            'message' => 'Valoración actualizada',
            'valoracion' => $valoracion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function eliminarValoracion($id)
    {
        // Buscar la valoración por ID
        $valoracion = Valoracion::find($id);

        if (!$valoracion) {
            $data = [
                'message' => 'Valoración no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Verificar si el usuario es el propietario de la valoración
        // Aquí se verifica que el usuario autenticado sea el propietario de la valoración
        //if ($valoracion->user_id !== auth()->id()) {
        //    $data = [
        //        'message' => 'No tienes permiso para eliminar esta valoración',
        //        'status' => 403
        //    ];
        //    return response()->json($data, 403);
        //}

        // Eliminar la valoración
        $valoracion->delete();

        // Respuesta de éxito
        $data = [
            'message' => 'Valoración eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function ValoracionesPorProducto($prod_id)
    {
        // Obtener todas las valoraciones asociadas al producto
        $valoraciones = Valoracion::where('prod_id', $prod_id)->get();

        if ($valoraciones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron valoraciones para este producto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'valoraciones' => $valoraciones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function ValoracionesPorUsuario($user_id)
    {
        // Obtener todas las valoraciones realizadas por el usuario
        $valoraciones = Valoracion::where('user_id', $user_id)->get();

        if ($valoraciones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron valoraciones de este usuario',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'valoraciones' => $valoraciones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function promedioPuntuacionProducto($prod_id)
    {
        // Obtener todas las valoraciones asociadas al producto
        $valoraciones = Valoracion::where('prod_id', $prod_id)->get();

        if ($valoraciones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron valoraciones para este producto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Calcular el promedio de las puntuaciones
        $promedio = $valoraciones->avg('puntuacion');

        $data = [
            'promedio_puntuacion' => $promedio,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function filtrarValoracionesPorPuntuacion(Request $request, $prod_id)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'min_puntuacion' => 'required|integer|min:1|max:5',
            'max_puntuacion' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Obtener las valoraciones dentro del rango de puntuación especificado
        $valoraciones = Valoracion::where('prod_id', $prod_id)
            ->whereBetween('puntuacion', [$request->min_puntuacion, $request->max_puntuacion])
            ->get();

        if ($valoraciones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron valoraciones dentro del rango especificado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'valoraciones' => $valoraciones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
