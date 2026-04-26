<?php

namespace App\Http\Controllers;

use App\Models\TypesServices;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypesServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('services/services', [
            'typesServices' => TypesServices::All(),
            'services' => Services::All()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create (Request $request, int $nb): View
    {
        $name = Services::select('name')->get();
        $description = Services::select('description')->get();

        return view('services/servicesCreate', ['name' => $name, 'description' => $description]);
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
     */
    public function show(TypesServices $typesServices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypesServices $typesServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypesServices $typesServices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypesServices $typesServices)
    {
        //
    }

    public function indexByCategory(Request $request, int $id) : View
    {
        return view('services/categorie', ['typeService'=> TypesServices::find($id),
        'services' => Services::all()]);
    }
}
