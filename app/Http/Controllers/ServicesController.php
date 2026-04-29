<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\TypesServices;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\VarDumper\VarDumper;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('services/services', [
            'typesServices' => TypesServices::All(),
            'services' => Services::All()
        ]);
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
    public function show(Services $services)
    {
        //
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
