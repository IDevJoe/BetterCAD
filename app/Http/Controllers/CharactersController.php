<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterEditRequest;
use App\Models\Character;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->characters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Character
     */
    public function store(CharacterEditRequest $request)
    {
        $c = new Character([
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'dob' => $request->get('dob'),
            'hair_color' => $request->get('hair_color'),
            'eye_color' => $request->get('eye_color'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'race' => $request->get('race'),
            'height' => $request->get('height'),
            'weight' => $request->get('weight'),
            'user_id' => $request->user()->id
        ]);
        $c->save();
        return $c;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return Character
     */
    public function show(Request $request, Character $character)
    {
        if ($character->user_id != $request->user()->id) {
            throw new UnauthorizedHttpException();
        }
        return $character;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return Character
     */
    public function update(CharacterEditRequest $request, Character $character)
    {
        if ($character->user_id != $request->user()->id) {
            throw new UnauthorizedHttpException();
        }
        $character->fname = $request->get('fname');
        $character->lname = $request->get('lname');
        $character->hair_color = $request->get('hair_color');
        $character->address = $request->get('address');
        $character->height = $request->get('height');
        $character->weight = $request->get('weight');
        $character->dl_type = $request->get('dl_type', 'UNL');
        $character->dl_status = $request->get('dl_status', 'V');
        $character->dl_expiry = $request->get('dl_expiry');
        $character->wl_status = $request->get('wl_status', 'U');
        $character->wl_expiry = $request->get('wl_expiry');
        $character->bl_status = $request->get('bl_status', 'U');
        $character->bl_expiry = $request->get('bl_expiry');
        $character->pl_type = $request->get('pl_type', 'U');
        $character->pl_status = $request->get('pl_status', 'V');
        $character->pl_expiry = $request->get('pl_expiry');
        if (!$character->dead && $request->get('dead')) {
            $character->dead = true;
            $character->dead_since = Carbon::now();
        }
        if ($character->dl_type == "UNL") {
            $character->dl_status = "V";
            $character->dl_expiry = null;
        } elseif ($character->dl_expiry == null) {
            $character->dl_expiry = Carbon::now()->addYears(2)->toDateString();
        }
        if ($character->wl_status == "U") {
            $character->wl_expiry = null;
        } elseif ($character->wl_expiry == null) {
            $character->wl_expiry = Carbon::now()->addYears(2)->toDateString();
        }
        if ($character->bl_status == "U") {
            $character->bl_expiry = null;
        } elseif ($character->bl_expiry == null) {
            $character->bl_expiry = Carbon::now()->addYears(2)->toDateString();
        }
        if ($character->pl_type == "U") {
            $character->pl_status = "V";
            $character->pl_expiry = null;
        } elseif ($character->pl_expiry == null) {
            $character->pl_expiry = Carbon::now()->addYears(2)->toDateString();
        }
        $character->save();
        return $character;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Character $character)
    {
        if ($character->user_id != $request->user()->id) {
            throw new UnauthorizedHttpException();
        }
        $character->delete();
        return response(null, 204);
    }
}
