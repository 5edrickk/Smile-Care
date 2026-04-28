<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShiftsController extends Controller
{
    //
    public function index() {
        $shifts = Shift::where('id_user', '=', auth()->user()->id)->get();
        if(count($shifts) > 0) {
            $shifts = Shift::where('id_user', '=', auth()->user()->id)->orderBy('heure_punch', 'desc')->get();
        }

        return view('shifts/shiftsView', [
            'shifts' => $shifts,
        ]);
    }
    public function punch() {
        $shifts = Shift::where('id_user', '=', auth()->user()->id)->get();
        if(count($shifts) > 0) {
            $shifts = Shift::where('id_user', '=', auth()->user()->id)->orderBy('heure_punch', 'desc')->get();
            $lastShift = $shifts[0];
        }

        $newShift = new Shift;
        $newShift->id_user = auth()->user()->id;
        $newShift->heure_punch = now();
        if(count($shifts) > 0) {
            if($lastShift->state === "enter") {
                $newShift->state = "exit";
            }
            elseif($lastShift->state === "exit") {
                $newShift->state = "enter";
            }
        }
        else {
            $newShift->state = "enter";
        }
        $newShift->save();

        return redirect()->route('shifts', ['shifts' => $shifts]);
    }
}
