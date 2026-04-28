<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShiftsController extends Controller
{
    //
    public function index() {
        return view('shifts/shiftsView', [
            'shifts' => Shift::where('id_user', '=', auth()->user()->id)->orderBy('heure_punch', 'desc')->get(),
        ]);
    }
    public function punch() {
        $shifts = Shift::where('id_user', '=', auth()->user()->id)->orderBy('heure_punch', 'desc')->get();
        $lastShift = $shifts[0];

        $newShift = new Shift;
        $newShift->id_user = auth()->user()->id;
        $newShift->heure_punch = now();
        if($lastShift->state === "enter") {
            $newShift->state = "exit";
        }
        elseif($lastShift->state === "exit") {
            $newShift->state = "enter";
        }
        $newShift->save();

        return redirect()->route('shifts', ['shifts' => $shifts]);
    }
}
