<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PermissionRole extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $didq = DB::selectOne("SELECT * FROM `role_discord_ids` WHERE `role_id`=?", [$this->id]);
        $did = ($didq == null ? null : $didq->discord_role_id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discord_id' => $did,
            'permissions' => $this->getPermissionNames()
        ];
    }
}
