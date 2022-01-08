<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RolesController extends Controller
{

    public function get()
    {
        return PermissionRole::collection(Role::get());
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $r = Role::create(['name' => $request->get('name'), 'guard_name' => 'web']);
        return new PermissionRole($r);
    }

    public function getRole($r)
    {
        $rr = Role::where('id', $r)->first();
        if ($rr == null) {
            throw new NotFoundHttpException();
        }
        return new PermissionRole($rr);
    }

    public function modify(Request $request, $r)
    {
        $this->validate($request, [
            'discord_id' => 'nullable|string'
        ]);
        $rr = Role::where('id', $r)->first();
        if ($rr == null) {
            throw new NotFoundHttpException();
        }
        if ($request->get('discord_id') == null) {
            DB::delete("DELETE FROM `role_discord_ids` WHERE `role_id`=?", [$rr->id]);
        } else {
            $rdiq = DB::selectOne("SELECT `id` FROM `role_discord_ids` WHERE `role_id`=?", [$rr->id]);
            if ($rdiq == null) {
                DB::insert(
                    "INSERT INTO `role_discord_ids` (`role_id`, `discord_role_id`) VALUES(?, ?)",
                    [$rr->id, $request->get('discord_id')]
                );
            } else {
                DB::update(
                    "UPDATE `role_discord_ids` SET `discord_role_id`=? WHERE `role_id`=?",
                    [$request->get('discord_id'), $rr->id]
                );
            }
        }
        return new PermissionRole($rr);
    }

    public function assignPermission(Request $request, $r)
    {
        $this->validate($request, [
            'permission' => 'required|string'
        ]);
        $rr = Role::where('id', $r)->first();
        if ($rr == null) {
            throw new NotFoundHttpException();
        }
        $rr->givePermissionTo($request->get('permission'));
        return new PermissionRole($rr);
    }

    public function unassignPermission(Request $request, $r)
    {
        $this->validate($request, [
            'permission' => 'required|string'
        ]);
        $rr = Role::where('id', $r)->first();
        if ($rr == null) {
            throw new NotFoundHttpException();
        }
        $rr->revokePermissionTo($request->get('permission'));
        return new PermissionRole($rr);
    }

    public function delete(Request $request, $r)
    {
        $rr = Role::where('id', $r)->first();
        if ($rr == null) {
            throw new NotFoundHttpException();
        }
        $rr->delete();
        return response(null, 204);
    }
}
