<?php

namespace App\Http\Controllers;

use App\Models\EtatsPaiement;
use App\Models\Paiement;
use App\Models\RendezVous;
use App\Models\TypesPaiements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Http\Resources\PaiementResource;

class PaiementController extends Controller
{
    public function index(): mixed
    {
        $paiements = Paiement::with([
            'rendezVous',
            'etatPaiement',
            'typePaiement'
        ])->get();

        if (request()->is('api/*')) {
            return PaiementResource::collection($paiements);
        }

        return view('paiements.index', [
            'paiements' => $paiements
        ]);
    }

    public function show(int $id): mixed
    {
        $paiement = Paiement::with([
            'rendezVous',
            'etatPaiement',
            'typePaiement'
        ])->findOrFail($id);

        if (request()->is('api/*')) {
            return new PaiementResource($paiement);
        }

        return view('paiements.show', [
            'paiement' => $paiement
        ]);
    }


    public function create(): View
    {
        return view('paiements.create', [
            'rendezVous'  => RendezVous::all(),
            'etats'       => EtatsPaiement::all(),
            'types'       => TypesPaiements::all(),
        ]);
    }

    public function store(Request $request): mixed
    {
        $validation = Validator::make($request->all(), [
            'montant'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'id_rendez_vous' => 'required|exists:rendez_vous,id',
            'id_etat'        => 'required|exists:etats_paiements,id',
            'id_type'        => 'required|exists:types_paiements,id',
        ], [
            'montant.required'        => 'Le montant est obligatoire.',
            'montant.regex'           => 'Le montant doit être un nombre valide (ex: 99.99).',
            'id_rendez_vous.required' => 'Veuillez sélectionner un rendez-vous.',
            'id_rendez_vous.exists'   => 'Le rendez-vous sélectionné est invalide.',
            'id_etat.required'        => 'Veuillez sélectionner un état.',
            'id_type.required'        => 'Veuillez sélectionner un type de paiement.',
        ]);

        if ($validation->fails()) {
            if (request()->is('api/*')) {
                return response()->json([
                    'ERREUR' => $validation->errors()
                ], 400);
            }
            // Web → retour formulaire
            return back()->withErrors($validation->errors())->withInput();
        }

        try {
            $paiement = Paiement::create($validation->validated());
        } catch (\Illuminate\Database\QueryException $e) {
            if (request()->is('api/*')) {
                return response()->json([
                    'ERREUR' => 'Le paiement n\'a pas pu être ajouté.'
                ], 500);
            }
            return back()->with('erreur', 'Le paiement n\'a pas pu être ajouté.');
        }

        if (request()->is('api/*')) {
            return response()->json([
                'SUCCÈS' => 'Paiement ajouté avec succès.',
                'data'   => new PaiementResource($paiement)
            ], 200);
        }

        return redirect()->route('paiements.index')
            ->with('succes', 'Paiement ajouté avec succès.');
    }

    public function edit(int $id): View
    {
        $paiement = Paiement::findOrFail($id);

        return view('paiements.edit', [
            'paiement'    => $paiement,
            'rendezVous'  => RendezVous::all(),
            'etats'       => EtatsPaiement::all(),
            'types'       => TypesPaiements::all(),
        ]);
    }


    public function update(Request $request, int $id): mixed
    {
        $paiement = Paiement::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'montant'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'id_rendez_vous' => 'required|exists:rendez_vous,id',
            'id_etat'        => 'required|exists:etats_paiements,id',
            'id_type'        => 'required|exists:types_paiements,id',
        ], [
            'montant.required'        => 'Le montant est obligatoire.',
            'montant.regex'           => 'Le montant doit être un nombre valide (ex: 99.99).',
            'id_rendez_vous.required' => 'Veuillez sélectionner un rendez-vous.',
            'id_etat.required'        => 'Veuillez sélectionner un état.',
            'id_type.required'        => 'Veuillez sélectionner un type de paiement.',
        ]);

        if ($validation->fails()) {
            if (request()->is('api/*')) {
                return response()->json([
                    'ERREUR' => $validation->errors()
                ], 400);
            }
            return back()->withErrors($validation->errors())->withInput();
        }

        $paiement->montant        = $request->montant;
        $paiement->id_rendez_vous = $request->id_rendez_vous;
        $paiement->id_etat        = $request->id_etat;
        $paiement->id_type        = $request->id_type;

        if ($paiement->save()) {
            if (request()->is('api/*')) {
                return response()->json([
                    'SUCCÈS' => 'Paiement modifié avec succès.',
                    'data'   => new PaiementResource($paiement)
                ], 200);
            }
            return redirect()->route('paiements.index')
                ->with('succes', 'Paiement modifié avec succès.');
        }

        if (request()->is('api/*')) {
            return response()->json([
                'ERREUR' => 'Échec de la modification.'
            ], 500);
        }

        return back()->with('erreur', 'Échec de la modification.');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $paiements = Paiement::with(['rendezVous', 'etatPaiement', 'typePaiement'])
            ->whereHas('etatPaiement', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('typePaiement', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhere('montant', 'like', "%{$query}%")
            ->get();

        return response()->json($paiements->map(function ($p) {
            return [
                'id'      => $p->id,
                'montant' => $p->montant,
                'etat'    => $p->etatPaiement->name ?? '-',
                'type'    => $p->typePaiement->name ?? '-',
                'rdv'     => $p->id_rendez_vous,
            ];
        }));
    }
}
