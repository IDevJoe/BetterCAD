<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    private function compile($question, $answer)
    {
        return "% BETTERCAD RECORDS SEARCH"
            . "\n% GENERATED " . Carbon::now()->toIso8601ZuluString()
            . "\n\n;; QUESTION SECTION\n" . $question
            . "\n\n;; ANSWER SECTION\n" . $answer;
    }

    public function lookupPerson(Request $request)
    {
        $this->validate($request, [
            'fname' => 'nullable|string|max:100',
            'lname' => 'nullable|string|max:100',
            'dob' => 'nullable|date'
        ]);
        $cs = Character::where('id', '>', 0);
        if ($request->has('fname')) {
            $cs = $cs->whereRaw('UPPER(fname) LIKE ?', strtoupper($request->get('fname')));
        }
        if ($request->has('lname')) {
            $cs = $cs->whereRaw('UPPER(lname) LIKE ?', strtoupper($request->get('lname')));
        }
        if ($request->has('dob')) {
            $cs = $cs->where('dob', $request->get('dob'));
        }
        $cs = $cs->limit(10)->get();
        $question = $request->get('lname') . ",\t" . $request->get('fname') . "\t" . $request->get('dob');
        $answer = "";
        $i = 0;
        foreach ($cs as $c) {
            $answer .= "*** (" . ($i + 1) . "/" . sizeof($cs) . ")\n" . $c->dbAnswer()
                . "\n-- VEHICLES --";
            foreach ($c->vehicles as $v) {
                $answer .= "\n" . $v->dbAnswer();
            }
        }
        return $this->compile($question, $answer);
    }
}
