<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Enums\TipoUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        return response()->json(User::all());
    }

    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tipo_usuario' => ['required', Rule::enum(TipoUsuario::class)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);

        return response()->json($user);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8',
            'tipo_usuario' => ['sometimes', Rule::enum(TipoUsuario::class)],
        ]);

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->only(['name', 'email', 'password', 'tipo_usuario']));

        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}