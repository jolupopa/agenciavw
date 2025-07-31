<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Typeproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypepropertyFormRequest;
use App\Http\Resources\TypepropertiesResource;


class TypepropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);  // Get per_page from request, default to 5

        $typeproperties = Typeproperty::query();

        if($request->filled('search'))
            {
                $search = $request->search;

            $typeproperties->where(fn($query) =>
                $query->where('name', 'like', '%' . $search . '%'));
            };


        $typeproperties = $typeproperties->orderBy('name')->paginate($perPage)->withQueryString();;

        // dd($typeproperties);
       // dump($request->all());
        return Inertia::render('typeproperties/index', [
            'typeproperties' => TypepropertiesResource::collection($typeproperties),
            'filters' =>$request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('typeproperties/typeproperty-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypepropertyFormRequest $request)
    {
        //dd($request->all());
        try {
        $typeproperty = Typeproperty::create([
            'name' => $request->name,
            'active' => $request->active,
        ]);

            if ($typeproperty){
                return redirect()->route('typeproperty.index')->with('success', 'Tipo de propiedad creada correctamente');
            }
            return redirect()->back()->with('error', 'Error al crear el tipo de propiedad');


        } catch (Exception $e) {
              Log::error('Typeproperty creation failed: ' . $e->getMessage());

        }

        return redirect()->back()->with('error', 'Error al crear el tipo de propiedad');


    }

    /**
     * Display the specified resource.
     */
    public function show(Typeproperty $typeproperty)
    {
        return Inertia::render('typeproperties/typeproperty-form', [
            'typeproperty' => $typeproperty,
            'isView' => true,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Typeproperty $typeproperty)
    {
        return Inertia::render('typeproperties/typeproperty-form', [
            'typeproperty' => $typeproperty,
            'isEdit' => true,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypepropertyFormRequest $request, Typeproperty $typeproperty)
    {
        try {
            if($typeproperty) {
                $typeproperty->name = $request->name;
                $typeproperty->active = $request->active;
                $typeproperty->save();
                return redirect()->route('typeproperty.index')->with('success', 'Tipo de propiedad ACTYALIZADA correctamente');
            }
            return redirect()->back()->with('error', 'Error al actualizar  el tipo de propiedad vuelve a intentarlo');
        } catch (Exception $e) {
            Log::error('fallo actualizando typeproperty' . $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Typeproperty $typeproperty)
    {
        try {
            if ( $typeproperty ) {
                $typeproperty->delete();
                return redirect()->back()->with('success', 'Tipo de propiedad eliminado');
            }
            return redirect()->back()->with('error', 'Error al eliminar, vuelve a intentarlo');
        } catch (Exeption $e) {

            Log::error('fallo eliminacion de typeproperty' . $e->getMessage());

        }
    }
}
