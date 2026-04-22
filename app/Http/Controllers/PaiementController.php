<?php

namespace App\Http\Controllers;

use App\Models\EtatsPaiement;
use App\Models\Paiement;
use App\Models\RendezVous;
use App\Models\TypesPaiements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PaiementController extends Controller
{
    public function index(): View
    {
        $paiements = Paiement::with([
            'rendezVous',
            'etatPaiement',
            'typePaiement'
        ])->get();

        return view('paiements.index', [
            'paiements' => $paiements
        ]);
    }

    public function show(int $id): View
    {
        $paiement = Paiement::with([
            'rendezVous',
            'etatPaiement',
            'typePaiement'
        ])->findOrFail($id);

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

    public function store(Request $request)
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
            return back()
                ->withErrors($validation->errors())
                ->withInput();
        }

        Paiement::create($validation->validated());

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


    public function update(Request $request, int $id)
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
            return back()
                ->withErrors($validation->errors())
                ->withInput();
        }

        $paiement->montant        = $request->montant;
        $paiement->id_rendez_vous = $request->id_rendez_vous;
        $paiement->id_etat        = $request->id_etat;
        $paiement->id_type        = $request->id_type;

        if ($paiement->save()) {
            return redirect()->route('paiements.index')
                ->with('succes', 'Paiement modifié avec succès.');
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
