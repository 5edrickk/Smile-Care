<?php

namespace App\Http\Controllers;

use App\Models\EtatsRendezVous;
use App\Models\RendezVous;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        if (auth()->user() != null && auth()->user()->id_role === 4) {
            return view('rendezVous/rendezvous', ['rendezVous' => RendezVous::where('id_dentiste', '=', auth()->user()->id)->with('user', 'dentiste', 'service')->get(),
            ]);
        }

        $rendezVous = RendezVous::with('user', 'dentiste', 'service')->get();

        return view('rendezVous/rendezvous', ['rendezVous' => $rendezVous]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //modifier
    {
        $dentistes = User::where('id_role', 4)->get();
        $clients = User::where('id_role', 5)->get();
        $etatsRendezVous = EtatsRendezVous::all();
        $services = Services::all();
        $heures = RendezVous::select('heure_date')->distinct()->get();

        return view('rendezVous/rendezvousCreate', ['dentistes' => $dentistes, 'clients' => $clients, 'etatsRendezVous' => $etatsRendezVous, 'services' => $services, 'heures' => $heures]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'id_dentiste' => 'required|integer|exists:users,id',
            'id_etat' => 'required|integer|exists:etats_rendez_vous,id',
            'id_service' => 'required|integer|exists:services,id',
            'heure_date' => 'required|date',
            'commentaire' => 'nullable|string|max:500',
        ]);

        $rendezVous = new RendezVous;
        $rendezVous->id_user = $request->id_user;
        $rendezVous->id_dentiste = $request->id_dentiste;
        $rendezVous->id_etat = $request->id_etat;
        $rendezVous->id_service = $request->id_service;
        $rendezVous->heure_date = $request->heure_date;
        $rendezVous->commentaire = $request->commentaire;
        $rendezVous->save();

        return redirect()->route('rendezvous')->with('success', 'Rendez-vous ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        if ($id) {
            $rendezVous = RendezVous::find($id);
            $dentiste = User::find($rendezVous->id_dentiste);
            $etatRendezVous = EtatsRendezVous::find($rendezVous->id_etat);

            return view('rendezVous/rendezvousId', ['rendezVous' => $rendezVous, 'dentiste' => $dentiste, 'etatRendezVous' => $etatRendezVous]);
        }

        return redirect()->route('rendezvous')->with('error', 'Rendez-vous non trouvé');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $dentistes = User::where('id_role', 4)->get();
        $etatsRendezVous = EtatsRendezVous::all();
        $services = Services::all();
        $heures = RendezVous::select('heure_date')->distinct()->get();

        return view('rendezVous/rendezvousEdit', ['rendezVous' => $rendezVous, 'dentistes' => $dentistes, 'etatsRendezVous' => $etatsRendezVous, 'services' => $services, 'heures' => $heures]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->id_dentiste = $request->id_dentiste;
        $rendezVous->id_etat = $request->id_etat;
        $rendezVous->id_service = $request->id_service;
        $rendezVous->heure_date = $request->heure_date;
        $rendezVous->commentaire = $request->commentaire;
        $rendezVous->save();

        return redirect()->route('rendezvous')->with('success', 'Rendez-vous modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id_rendez_vous');
        $rendezVous = RendezVous::find($id);

        if (!$rendezVous)
            return redirect()->route('rendezvous')->with('error', 'La suppression du rendez-vous a échoué');

        $rendezVous->paiements()->delete();
        $rendezVous->delete();

        return redirect()->route('rendezvous')->with('success', 'La suppression du rendez-vous a bien fonctionné.');
    }
}
