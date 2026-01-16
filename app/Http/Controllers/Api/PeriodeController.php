<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Periode::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $periode = Periode::create($request->all());
        return response()->json($periode,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        return $periode;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        $periode->update($request->all());
        return response()->json($periode,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $periode->delete();
   
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
 }
    }

