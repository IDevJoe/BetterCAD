<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get()
    {
        return User::get();
    }

    public function getUser(User $user)
    {
        return $user;
    }

    public function modify(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $user->name = $request->get('name');
        $user->save();
        return $user;
    }

    public function assignPermission(Request $request, User $user)
    {
        $this->validate($request, [
            'permission' => 'required|string'
        ]);
        $user->givePermissionTo($request->get('permission'));
        return $user;
    }

    public function unassignPermission(Request $request, User $user)
    {
        $this->validate($request, [
            'permission' => 'required|string'
        ]);
        $user->revokePermissionTo($request->get('permission'));
        return $user;
    }

    public function assignRole(Request $request, User $user)
    {
        $this->validate($request, [
            'role' => 'required|string'
        ]);
        $user->assignRole($request->get('role'));
        return $user;
    }

    public function unassignRole(Request $request, User $user)
    {
        $this->validate($request, [
            'role' => 'required|string'
        ]);
        $user->removeRole($request->get('role'));
        return $user;
    }
}
