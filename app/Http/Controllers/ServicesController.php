<?php

namespace App\Http\Controllers;

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
        return Services::All();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $name = Services::select('name')->get();
        $description = Services::select('description')->get();
        $duree = Services::select('duree')->get();
        $id_type = TypesServices::all();

        return view('services/servicesCreate', ['name' => $name, 'description' => $description, 'duree' => $duree, 'id_type' => $id_type]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'id_type' => 'required|integer|exists:type_services,id',
            'duree' => 'nullable|float|regex:/[0-9]*',
        ]);

        $service = new Services;
        $service->name = $request->service_name;
        $service->description = $request->service_description;
        $service->id_type = $request->service_categorie;
        $service->duree = $request->service_duree;
        $service->save();

        return redirect()->route('services')->with('success', 'MESSAGE TEST(GOOD)');
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
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        //
    }
}
