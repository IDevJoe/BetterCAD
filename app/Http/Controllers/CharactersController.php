<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterEditRequest;
use App\Models\Character;
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
}
