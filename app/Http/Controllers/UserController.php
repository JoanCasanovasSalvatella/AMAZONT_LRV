<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function mostrarUser() {
        $users = User::all();

        if ($users->isEmpty()) {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'users' => $users,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function mostrarUnSoloUser($id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function verificarCorreo(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json(null, 200); // Correo EXISTE
        }

        return response()->json(['error' => 'Correo no encontrado'], 404);
    }

    public function crearUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'rol' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol
        ]);

        if (!$user) {
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'user' => $user,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function loginUser(Request $request) {
        // Validar que los campos email y password estén presentes
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Verificar si el usuario existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $data = [
                'message' => 'Correo electrónico no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Verificar que la contraseña sea correcta
        if (!Hash::check($request->password, $user->password)) {
            $data = [
                'message' => 'Contraseña incorrecta',
                'status' => 401
            ];
            return response()->json($data, 401);
        }

        // Si todo es correcto, generar el token de acceso (si usas API Token o JWT)
        // $token = $user->createToken('AppToken')->plainTextToken;

        $data = [
            'message' => 'Login exitoso',
            'user' => $user,
            // 'token' => $token,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function enviarCode(Request $request) {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        // Generar un código aleatorio de 5 dígitos
        $codigo = random_int(10000, 99999);

        // Guardar el código en la base de datos (puedes usar un campo específico o una tabla de recuperación)
        $user->recovery_code = $codigo;
        $user->code_expires_at = now()->addMinutes(10); // Establece un tiempo de expiración
        $user->save();

        // Enviar el código por correo electrónico
        Mail::to($user->email)->send(new CodigoRecuperacionMail($codigo));

        return response()->json(['message' => 'Código enviado al correo electrónico'], 200);
    }

    public function verificarCode(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'codigo' => 'required|integer'
        ]);

        $user = User::where('email', $request->email)->first();

        // Verificar que el código sea correcto y no haya expirado
        if ($user->recovery_code != $request->codigo || $user->code_expires_at < now()) {
            return response()->json(['error' => 'Código inválido o expirado'], 400);
        }

        // Código válido, restablecer el recovery_code para evitar reutilización
        $user->recovery_code = null;
        $user->code_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Código verificado correctamente'], 200);
    }

    public function verificarPassword(Request $request) {
        // Validar que los campos email y password estén presentes
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        // Verificar si el usuario existe
        $user = User::where('email', $request->email)->first();

        // Verificar que la contraseña sea correcta
        if (Hash::check($request->password, $user->password)) {
            $data = [
                'message' => 'La contraseña es igual a la existente',
                'status' => 401
            ];
            return response()->json($data, 401);
        }

        $data = [
            'message' => 'Contraseña permitida',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function cambiarPassword(Request $request) {
        // Validar que los campos email y password estén presentes
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Verificar si el usuario existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $data = [
                'message' => 'Correo electrónico no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $user->password = bcrypt($request->password);

        $user->save();

        $data = [
            'message' => 'Contraseña actualizado',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function modificarUser(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'required',
            'rol' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->rol = $request->rol;
        $user->save();

        $data = [
            'message' => 'Usuario actualizado',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function modificarCampoUser(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|unique:users',
            'password' => 'min:8',
            'rol' => 'max:255'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('rol')) {
            $user->rol = $request->rol;
        }

        $user->save();

        $data = [
            'message' => 'Usuario actualizado',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function eliminarUser($id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $user->delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
