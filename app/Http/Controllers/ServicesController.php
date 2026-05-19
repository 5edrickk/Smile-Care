<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicesResource;
use App\Models\Services;
use App\Models\TypesServices;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::All();
        if($services){
            $typesServices = TypesServices::All();
            if(request()->is('api/*')) {
                $servicesArray = [];

                foreach ($services as $service) {
                    $element = new ServicesResource($service);
                    $element['id_type'] = TypesServices::find($element['id_type'])->name;

                    array_push($servicesArray, $element);
                }

                return $servicesArray;
            }
            else {
                return view('services/services', ['typesServices' => $typesServices, 'services' => $services]);
            }
        }
        else{
            if(request()->is('api/*')) {
                return response()->json([
                    'ERREUR' => 'Aucun service a été trouvé'
                ], 400);
            }
            else {
                session()->flash('error', 'Aucun service a été trouvé');
                return redirect()->route('services');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $id_type = TypesServices::all();

        return view('services/servicesCreate', ['id_type' => $id_type]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new Services;

        $service->name = $request->name;
        $service->description = $request->description;
        $service->id_type = $request->categorie;
        $service->duree = $request->duree;
        try{
            $service->save();
            if (request()->is('api/*')) {
                return response()->json([
                    'SUCCÈS' => 'Service ajouté avec succès',
                    'data' => new ServicesResource($service)
                ], 200);
            } else {
                session()->flash('success', 'Service ajouté avec succès');
                return redirect()->route('services');
            }
        }
        catch (QueryException $erreur) {
            report($erreur);
            if (request()->is('api/*')) {
                return response()->json(['ERREUR' => 'Le service n\'a pas été ajouté - ' . $erreur->getMessage()], 500);
            } else {
                session()->flash('error', 'Le service n\'a pas été ajouté');
                return redirect()->route('services');
            }
        }


        return redirect()->route('services')->with('success', 'Le service \"' . $service->name . '\" a été ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $service = Services::find($id);

        if($service){
            $categorie = TypesServices::find($service->id_type);
            if(request()->is('api/*')) {
                return new ServicesResource($service);
            }
            else {
                return view('services/servicesShow', ['service' => $service, 'categorie' => $categorie]);
            }
        }
        else{
            if(request()->is('api/*')) {
                return response()->json([
                    'ERREUR' => 'Service inexistant'
                ], 400);
            }
            else {
                session()->flash('error', 'Service inexistant');
                return redirect()->route('services');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $service = Services::findOrFail($id);
        $id_type = TypesServices::all();

        return view('services/servicesEdit', ['service' => $service, 'id_type' => $id_type]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $service = Services::findOrFail($id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->id_type = $request->categorie;
        $service->duree = $request->duree;
                try{
            $service->save();
            if (request()->is('api/*')) {
                return response()->json([
                    'SUCCÈS' => 'Le service \'' . $service->name . '\' a été modifié',
                    'data' => new ServicesResource($service)
                ], 200);
            } else {
                session()->flash('success', 'Le service \'' . $service->name . '\' a été modifié');
                return redirect()->route('services');
            }
        }
        catch (QueryException $erreur) {
            report($erreur);
            if (request()->is('api/*')) {
                return response()->json(['ERREUR' => 'Le service \'' . $service->name . '\' n\'a pas été modifié - ' . $erreur->getMessage()], 500);
            } else {
                session()->flash('error', 'Le service \'' . $service->name . '\' n\'a pas été modifié');
                return redirect()->route('services');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services, int $id)
    {
        $service = Services::findOrFail($id);

        if (!$service)
            return redirect()->route('services')->with('error', 'La suppression du service a échoué');

        $service->delete();

        return redirect()->route('services')->with('success', 'Le service a été supprimé.');
    }
}
