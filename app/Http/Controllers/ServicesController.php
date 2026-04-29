<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicesResource;
use App\Models\Services;
use App\Models\TypesServices;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
                $servicesAray = [];

                foreach ($services as $service) {
                    $element = new ServicesResource($service);
                    array_push($servicesAray, $element);
                }
                return $servicesAray;
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
        $service->name = $request->service_name;
        $service->description = $request->service_description;
        $service->id_type = $request->service_categorie;
        $service->duree = $request->service_duree;
        $service->save();

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
        $service->name = $request->service_name;
        $service->description = $request->service_description;
        $service->id_type = $request->service_categorie;
        $service->duree = $request->service_duree;
        if($service->save()){
            session('error', '');
        }

        return redirect()->route('services')->with('success', 'Le service \"' . $service->name . '\" a été modifié.');
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
