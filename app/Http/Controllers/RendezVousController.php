<?php

namespace App\Http\Controllers;

use App\Models\EtatsRendezVous;
use App\Models\RendezVous;
use App\Http\Resources\RendezVousResource;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

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
        $validation = Validator::make($request->all(), [
            'id_user' => 'required|integer|exists:users,id',
            'id_dentiste' => 'required|integer|exists:users,id',
            'id_etat' => 'required|integer|exists:etats_rendez_vous,id',
            'id_service' => 'required|integer|exists:services,id',
            'heure_date' => 'required|date|regex:/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/',
            'commentaire' => 'nullable|string|max:500',
        ], [
            'id_user.required' => 'Veuillez entrer l\'identifiant de l\'utilisateur.',
            'id_user.regex' => 'L\'identifiant de l\'utilisateur doit être un nombre supérieur ou égal à 0.',
            'id_dentiste.required' => 'Veuillez entrer l\'identifiant du dentiste.',
            'id_dentiste.regex' => 'L\'identifiant du dentiste doit être un nombre supérieur ou égal à 0.',
            'id_etat.required' => 'Veuillez entrer l\'identifiant de l\'état.',
            'id_etat.regex' => 'L\'identifiant de l\'état doit être un nombre supérieur ou égal à 0.',
            'id_service.required' => 'Veuillez entrer l\'identifiant du service.',
            'id_service.regex' => 'L\'identifiant du service doit être un nombre supérieur ou égal à 0.',
            'heure_date.required' => 'Veuillez entrer une date et une heure.',
            'heure_date.regex' => 'La date et l\'heure doivent être au format YYYY-MM-DDTHH:MM.',
            'commentaire.max' => 'Votre commentaire ne peut pas dépasser 500 caractères.',
        ]);

        if ($validation->fails()) {
            if ($request->routeIs('api.rendezvous.store')) {
                return response()->json(['ERREUR' => $validation->errors()], 400);
            } else {
                return back()->withErrors($validation->errors())->withInput();
            }
        }

        $contenuDecode = $validation->validated();

        try {
            $rendezVous = RendezVous::create([
                'id_user' => $contenuDecode['id_user'],
                'id_dentiste' => $contenuDecode['id_dentiste'],
                'id_etat' => $contenuDecode['id_etat'],
                'id_service' => $contenuDecode['id_service'],
                'heure_date' => $contenuDecode['heure_date'],
                'commentaire' => $contenuDecode['commentaire']
            ]);
            
            if ($request->routeIs('api.rendezvous.store')) {
                return response()->json([
                    'SUCCÈS' => 'Rendez-vous ajouté avec succès',
                    'data' => new RendezVousResource($rendezVous)
                ], 200);
            } else {
                session()->flash('success', 'Rendez-vous ajouté avec succès');
                return redirect()->route('rendezvous');
            }
        } catch (QueryException $erreur) {
            report($erreur);
            if ($request->routeIs('api.rendezvous.store')) {
                return response()->json(['ERREUR' => 'Le rendez-vous n\'a pas été ajouté.' . $erreur->getMessage()], 500);
            } else {
                session()->flash('error', 'Le rendez-vous n\'a pas été ajouté.');
                return redirect()->route('rendezvous');
            }
        }
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
            
            if (request()->is('api/*')) {
                return new RendezVousResource($rendezVous);
            } else {
                return view('rendezVous/rendezvousId', ['id' => $rendezVous->id, 'rendezVous' => $rendezVous, 'dentiste' => $dentiste, 'etatRendezVous' => $etatRendezVous]);
            }
        }
        else {
            if (request()->is('api/*')) {
                return response()->json([
                    'ERREUR' => 'Rendez-vous non trouvé'
                ], 400);
            } else {
                session()->flash('error', 'Rendez-vous non trouvé');
                return redirect()->route('rendezvous');
            }
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
        $rendezVous = RendezVous::find($id);
        if (!$rendezVous) {
            if ($request->routeIs('api.rendezvous.update')) {
                return response()->json(['ERREUR' => 'Rendez-vous non trouvé'], 400);
            } else {
                session()->flash('error', 'Rendez-vous non trouvé');
                return redirect()->route('rendezvous');
            }
        }

        $validation = Validator::make($request->all(), [
            'id_user' => 'required|integer|exists:users,id',
            'id_dentiste' => 'required|integer|exists:users,id',
            'id_etat' => 'required|integer|exists:etats_rendez_vous,id',
            'id_service' => 'required|integer|exists:services,id',
            'heure_date' => 'required|date|regex:/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/',
            'commentaire' => 'nullable|string|max:500',
        ], [
            'id_user.required' => 'Veuillez entrer l\'identifiant de l\'utilisateur.',
            'id_user.regex' => 'L\'identifiant de l\'utilisateur doit être un nombre supérieur ou égal à 0.',
            'id_dentiste.required' => 'Veuillez entrer l\'identifiant du dentiste.',
            'id_dentiste.regex' => 'L\'identifiant du dentiste doit être un nombre supérieur ou égal à 0.',
            'id_etat.required' => 'Veuillez entrer l\'identifiant de l\'état.',
            'id_etat.regex' => 'L\'identifiant de l\'état doit être un nombre supérieur ou égal à 0.',
            'id_service.required' => 'Veuillez entrer l\'identifiant du service.',
            'id_service.regex' => 'L\'identifiant du service doit être un nombre supérieur ou égal à 0.',
            'heure_date.required' => 'Veuillez entrer une date et une heure.',
            'heure_date.regex' => 'La date et l\'heure doivent être au format YYYY-MM-DDTHH:MM.',
            'commentaire.max' => 'Votre commentaire ne peut pas dépasser 500 caractères.',
        ]);

        if ($validation->fails()) {
            if ($request->routeIs('api.rendezvous.update')) {
                return response()->json(['ERREUR' => $validation->errors()], 400);
            } else {
                return back()->withErrors($validation->errors())->withInput();
            }
        }

        $contenuDecode = $validation->validated();

        try {
            $rendezVous->update([
                'id_user' => $contenuDecode['id_user'] ?? $rendezVous->id_user,
                'id_dentiste' => $contenuDecode['id_dentiste'] ?? $rendezVous->id_dentiste,
                'id_etat' => $contenuDecode['id_etat'] ?? $rendezVous->id_etat,
                'id_service' => $contenuDecode['id_service'] ?? $rendezVous->id_service,
                'heure_date' => $contenuDecode['heure_date'] ?? $rendezVous->heure_date,
                'commentaire' => $contenuDecode['commentaire']
            ]);

            if ($request->routeIs('api.rendezvous.update')) {
                return response()->json([
                    'SUCCÈS' => 'Rendez-vous modifié avec succès',
                    'data' => new RendezVousResource($rendezVous)
                ], 200);
            } else {
                session()->flash('success', 'Rendez-vous modifié avec succès');
                return redirect()->route('rendezvous');
            }
        } catch (QueryException $erreur) {
            report($erreur);
            if ($request->routeIs('api.rendezvous.update')) {
                return response()->json(['ERREUR' => 'Le rendez-vous n\'a pas été modifié.' . $erreur->getMessage()], 500);
            } else {
                session()->flash('error', 'Le rendez-vous n\'a pas été modifié.');
                return redirect()->route('rendezvous');
            }
        }
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
