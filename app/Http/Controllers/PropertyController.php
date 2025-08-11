<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Land;
use App\Models\Building;
use App\Models\Proyect;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // return Inertia::render('properties/index');

         $properties = Property::with(['land_property', 'habitat_property',])
            ->orderBy('created_at', 'desc')
            ->get();

        dd($properties);


        return Inertia::render('Properties/Index', [
            'properties' => $properties,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return Inertia::render('properties/create');
        dd('crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);

        $request->validate([
            'code' => 'required|unique:properties',
            'title' => 'required',
            'property_type_id' => 'required|exists:property_types,id',
            // otros campos de validación
        ]);

        $property = Property::create($request->only([
            'code', 'title', 'description', 'latitude', 'longitude',
            'property_type_id', 'price',
        ]));

        switch ($property->propertyType->name) {
            case 'land':
                Land::create([
                    'property_id' => $property->id,
                    'area' => $request->area,
                    'land_type' => $request->land_type,
                ]);
                break;
            case 'building':
                Building::create([
                    'property_id' => $property->id,
                    'area' => $request->area,
                    'built_area' => $request->built_area,
                    'house_type' => $request->house_type,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garage' => $request->garage,
                ]);
                break;
            case 'proyect':
                Proyect::create([
                    'property_id' => $property->id,
                    'area' => $request->area,
                    'built_area' => $request->built_area,
                    'house_type' => $request->house_type,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garage' => $request->garage,
                ]);
                break;
        }

        return redirect()->route('properties.index')->with('success', 'Propiedad creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
         $property->load([ 'land', 'building', 'proyects']);

        return Inertia::render('Properties/Show', [
            'property' => $property,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
         $property->load(['land', 'building', 'proyects']);

        return Inertia::render('Properties/Edit', [
            'property' => $property,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'code' => 'required|unique:properties,code,' . $property->id,
            'title' => 'required',
            // otros campos de validación
        ]);

        $property->update($request->only([
            'code', 'title', 'description', 'latitude', 'longitude',
            'property_type_id', 'price', 'min_price', 'max_price'
        ]));

        switch ($property->type->name) {
            case 'land':
                $property->land->update([
                    'area' => $request->area,
                    'land_type' => $request->land_type,
                ]);
                break;
            case 'building':
                $property->building->update([
                    'area' => $request->area,
                    'built_area' => $request->built_area,
                    'house_type' => $request->house_type,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garage' => $request->garage,
                ]);
                case 'proyect':
                $property->proyect->update([
                    'area' => $request->area,
                    'built_area' => $request->built_area,
                    'house_type' => $request->house_type,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garage' => $request->garage,
                ]);
                break;
        }

        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada correctamente.');

    }
}
