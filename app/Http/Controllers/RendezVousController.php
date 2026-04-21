<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //
        return view('rendezVous/rendezvous', ['rendezVous' => RendezVous::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show(RendezVous $rendezVous): View
    {
        
        if ($rendezVous) {
            $rendezVous = RendezVous::find($rendezVous->id);
            return view('rendezVous/rendezvousId', ['rendezVous' => $rendezVous]);
        } else {
            $rendezVous = RendezVous::all();
            return view('rendezVous/rendezvous', ['rendezVous' => $rendezVous]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RendezVous $rendezVous)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RendezVous $rendezVous)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RendezVous $rendezVous)
    {
        //
    }
}
