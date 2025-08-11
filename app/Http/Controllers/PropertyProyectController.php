<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PropertyProyectController extends Controller
{
    public function index()
    {
        $items = DB::table('properties')
            ->select('title', DB::raw("'inmueble' as nombre_tabla"))
            ->unionAll(
                DB::table('proyects')
                    ->select('title', DB::raw("'proyecto' as nombre_tabla"))
            )
            ->get();

        dd($items);

        return Inertia::render('Items/Index', [
            'items' => $items,
        ]);
    }
}
