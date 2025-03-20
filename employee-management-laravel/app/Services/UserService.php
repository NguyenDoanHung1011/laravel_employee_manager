<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getAllUsers()
    {
        $user = Auth::user();
        
        if ($user->role->name === 'Admin') {
            return User::with(['role', 'department'])->get();
        } elseif ($user->role->name === 'Leader') {
            return User::with(['role', 'department'])
                       ->where('department_id', $user->department_id)
                       ->get();
        } else {
            return User::with(['role', 'department'])
                       ->where('department_id', $user->department_id)
                       ->where('id', '!=', $user->id)
                       ->get();
        }
    }

    public function getUserById($id)
    {
        $authUser = Auth::user();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($authUser->role->name === 'Admin' ||
            ($authUser->role->name === 'Leader' && $authUser->department_id === $user->department_id) ||
            ($authUser->role->name === 'Employee' && $authUser->id === $user->id)) {
            return response()->json($user);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function createUser($data)
    {
        $authUser = Auth::user();

        if ($authUser->role->name === 'Employee') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($authUser->role->name === 'Leader' && $authUser->department_id != $data['department_id']) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'department_id' => $data['department_id'],
        ]);

        return response()->json($user, 201);
    }

    public function updateUser($id, $data)
    {
        $authUser = Auth::user();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($authUser->role->name === 'Admin' ||
            ($authUser->role->name === 'Leader' && $authUser->department_id === $user->department_id)) {
            $user->update($data);
            return response()->json($user);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function deleteUser($id)
    {
        $authUser = Auth::user();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($authUser->role->name === 'Admin' ||
            ($authUser->role->name === 'Leader' && $authUser->department_id === $user->department_id)) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
