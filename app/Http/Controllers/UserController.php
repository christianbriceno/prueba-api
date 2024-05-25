<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Obtiene una lista de todos los usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json(['users' => $users, 'code' => 200]);
    }

    /**
     * Agrega un nuevo usuario
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json(['user' => $user, 'code' => 200]);
    }

    /**
     * Obtiene un usuario especifico
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['user' => $user, 'code' => 200]);
    }

    /**
     * Obtiene todos los usuarios que han comprado un producto
     *
     * @return \Illuminate\Http\Response
     */
    public function usersWithOrders()
    {
        $users = User::whereHas('orders')->get();

        return response()->json(['users' => $users, 'code' => 200]);
    }
}
