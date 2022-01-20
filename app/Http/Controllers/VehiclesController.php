<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Character $character)
    {
        if ($character->user_id != $request->user()->id) {
            throw new UnauthorizedHttpException('');
        }
        return $character->vehicles;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Character $character)
    {
        if ($character->user_id != $request->user()->id) {
            throw new UnauthorizedHttpException('');
        }
        $this->validate($request, [
            'plate_number' => [
                'required',
                'string',
                'max:10',
                Rule::unique('vehicles')->where(function ($query) use ($request) {
                    return $query->where('state', $request->get('state'))
                        ->where('plate_number', $request->get('plate_number'));
                })
            ],
            'state' => 'required|string|max:50',
            'color' => 'required|string|max:10',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'insurance_status' => 'required|string|max:2',
            'registration_status' => 'required|string|max:2'
        ]);
        $v = Vehicle::create([
            'plate_number' => $request->get('plate_number'),
            'state' => $request->get('state'),
            'color' => $request->get('color'),
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'insurance_status' => $request->get('insurance_status'),
            'registration_status' => $request->get('registration_status'),
            'character_id' => $character->id
        ]);
        return $v;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->character->user_id != $request->user()->id) {
            throw new UnauthorizedHttpException('');
        }
        $this->validate($request, [
            'insurance_status' => 'required|string|max:2',
            'registration_status' => 'required|string|max:2'
        ]);
        $vehicle->insurance_status = $request->get('insurance_status');
        $vehicle->registration_status = $request->get('registration_status');
        $vehicle->save();
        return $vehicle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
