<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class CarritoController extends Controller
{
    public function mostrarCart($user_id)
    {
        $carrito = Carrito::where('user_id', $user_id)->get();

        if ($carrito->isEmpty()) {
            return response()->json(['message' => 'El carrito está vacío', 'status' => 200], 200);
        }

        return response()->json(['carrito' => $carrito, 'status' => 200], 200);
    }

    public function agregarCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'prod_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $producto = Producto::find($request->prod_id);
        $carrito = Carrito::where('user_id', $request->user_id)->where('prod_id', $request->prod_id)->first();

        if ($carrito) {
            $carrito->cantidad += $request->cantidad;
            $carrito->total = $carrito->cantidad * $producto->precio;
            $carrito->save();
        } else {
            $carrito = Carrito::create([
                'user_id' => $request->user_id,
                'prod_id' => $request->prod_id,
                'cantidad' => $request->cantidad,
                'precio_producto' => $producto->precio,
                'total' => $request->cantidad * $producto->precio
            ]);
        }

        return response()->json(['message' => 'Producto agregado al carrito', 'carrito' => $carrito, 'status' => 201], 201);
    }

    public function eliminarCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'prod_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $carrito = Carrito::where('user_id', $request->user_id)->where('prod_id', $request->prod_id)->first();

        if (!$carrito) {
            return response()->json(['message' => 'Producto no encontrado en el carrito', 'status' => 404], 404);
        }

        if ($carrito->cantidad > $request->cantidad) {
            $carrito->cantidad -= $request->cantidad;
            $carrito->total = $carrito->cantidad * $carrito->precio_producto;
            $carrito->save();
        } else {
            $carrito->delete();
        }

        return response()->json(['message' => 'Producto actualizado/eliminado del carrito', 'status' => 200], 200);
    }

    public function totalCart($user_id)
    {
        $total = Carrito::where('user_id', $user_id)->sum('total');
        return response()->json(['total' => $total, 'status' => 200], 200);
    }

    public function confirmarCompra($user_id)
    {
        $carrito = Carrito::where('user_id', $user_id)->get();

        if ($carrito->isEmpty()) {
            return response()->json(['message' => 'El carrito está vacío', 'status' => 400], 400);
        }

        foreach ($carrito as $item) {
            Compra::create([
                'user_id' => $item->user_id,
                'prod_id' => $item->prod_id,
                'cantidad' => $item->cantidad,
                'precio_producto' => $item->precio_producto,
                'total' => $item->total
            ]);
            $item->delete();
        }

        return response()->json(['message' => 'Compra confirmada', 'status' => 201], 201);
    }
}
