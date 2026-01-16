<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisMagang;
use Illuminate\Http\Request;

class JenisMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(JenisMagang::all());
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
        $jenismagang = JenisMagang::create($request->all());
        return response()->json($jenismagang,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisMagang $jenisMagang)
    {
        return $jenisMagang;
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
    public function update(Request $request, JenisMagang $jenisMagang)
    {
        $jenisMagang->update($request->all());
        return response()->json($jenisMagang,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisMagang $jenisMagang)
    {
        $jenisMagang->delete();
   
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
