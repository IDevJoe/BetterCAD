<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublicSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getAllSettings()
    {
        return PublicSetting::collection(Setting::get());
    }

    public function putSetting(Request $request, $setting)
    {
        $this->validate($request, [
            'value' => 'nullable|string',
            'hash' => 'nullable|bool'
        ]);
        $s = Setting::where('name', $setting)->first();
        if ($request->get('value') == null) {
            if ($s != null) {
                $s->delete();
            }
            return response(null, 204);
        }
        if ($s == null) {
            $s = new Setting();
            $s->name = $setting;
        }
        $s->hash = $request->get('hash', false);
        $s->value = $request->get('value');
        $s->save();
        return new PublicSetting($s);
    }
}
