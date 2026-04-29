<?php

namespace App\Http\Controllers;

use App\Models\EtatsRendezVous;
use App\Models\RendezVous;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $user = Auth::user();

        if ($user != null && $user->id_role === 4) {
            return view('rendezVous/rendezvous', ['rendezVous' => RendezVous::where('id_dentiste', '=', $user->id)->with('user', 'dentiste', 'service')->get(),
            ]);
        }

        $rendezVous = RendezVous::with('user', 'dentiste', 'service')->get();

        return view('rendezVous/rendezvous', ['rendezVous' => $rendezVous]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //modifier les parametres
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
        $validated = $request->validate([
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

        if($rendezVous->save()) {
            session()->flash('success', 'Rendez-vous ajouté avec succès');
        } else {
            session()->flash('error', 'La création du rendez-vous a échoué');
        }

        return redirect()->route('rendezvous');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) //modifier les parametres
    {
        $rendezVous = RendezVous::find($id);

        if ($rendezVous) {
            $dentiste = User::find($rendezVous->id_dentiste);
            $etatRendezVous = EtatsRendezVous::find($rendezVous->id_etat);
            return view('rendezVous/rendezvousId', ['id' => $rendezVous->id, 'rendezVous' => $rendezVous, 'dentiste' => $dentiste, 'etatRendezVous' => $etatRendezVous]);
        }
        else {
            session()->flash('error', 'Rendez-vous non trouvé');
            return redirect()->route('rendezvous');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) //modifier les parametres
    {
        $rendezVous = RendezVous::find($id);

        if (!$rendezVous) {
            session()->flash('error', 'Rendez-vous non trouvé');
            return redirect()->route('rendezvous');
        }

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
        $validated = $request->validate([
            'id_dentiste' => 'required|integer|exists:users,id',
            'id_etat' => 'required|integer|exists:etats_rendez_vous,id',
            'id_service' => 'required|integer|exists:services,id',
            'heure_date' => 'required|date|regex:/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/',
            'commentaire' => 'nullable|string|max:500',
        ]);

        $rendezVous = RendezVous::find($id);
        if (!$rendezVous) {
            session()->flash('error', 'Rendez-vous non trouvé');
            return redirect()->route('rendezvous');
        }

        $rendezVous->id_dentiste = $validated['id_dentiste'];
        $rendezVous->id_etat = $validated['id_etat'];
        $rendezVous->id_service = $validated['id_service'];
        $rendezVous->heure_date = $validated['heure_date'];
        $rendezVous->commentaire = $validated['commentaire'];

        if($rendezVous->save()) {
            session()->flash('success', 'Rendez-vous modifié avec succès');
        } else {
            session()->flash('error', 'La modification du rendez-vous a échoué');
        }

        return redirect()->route('rendezvous');
    }

    /**
     * Search for a resource.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $rendezvousQuery = RendezVous::select('id', 'id_user', 'id_dentiste', 'id_etat', 'id_service', 'heure_date', 'commentaire')
            ->with(['user', 'dentiste', 'service', 'etatsRendezVous'])
            ->where(function($queryBuilder) use ($query) {
                $queryBuilder
                    ->whereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%")
                          ->orWhere('prenom', 'like', "%{$query}%");
                    })
                    ->orWhereHas('dentiste', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%")
                          ->orWhere('prenom', 'like', "%{$query}%");
                    })
                    ->orWhereHas('service', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%");
                    });
            });

        $user = Auth::user();
        if ($user != null && $user->id_role === 4) {
            $rendezvousQuery->where('id_dentiste', '=', $user->id);
        }

        $rendezvous = $rendezvousQuery->get();

        return response()->json($rendezvous->map(function ($r) {
            return [
                'id'      => $r->id,
                'user'    => $r->user->name . ' ' . $r->user->prenom,
                'dentiste' => $r->dentiste->name . ' ' . $r->dentiste->prenom,
                'service' => $r->service->name,
                'heure_date' => $r->heure_date,
                'commentaire' => $r->commentaire,
                'etat' => optional($r->etatsRendezVous)->name,
            ];
        }));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id_rendez_vous');
        $rendezVous = RendezVous::find($id);

        if (!$rendezVous){            
            session()->flash('error', 'La suppression du rendez-vous a échoué : Rendez-vous non trouvé');
            return redirect()->route('rendezvous');
        }

        $rendezVous->paiements()->delete(); //modifier pour dans le cas ou il n'y a pas de paiement pour ce rendez vous : ajouter un try-catch peutetre

        if($rendezVous->delete()){
            session('success', 'Le rendez vous a ete supprime avec succes');
        }
        else {
            session('error', 'La suppression du rendez-vous a echoue.');
        }

        return redirect()->route('rendezvous')->with('success', 'La suppression du rendez-vous a bien fonctionné.');
    }
}
