<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BidangPerusahaan;

class BidangPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(BidangPerusahaan::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bidangperusahaan = BidangPerusahaan::create($request->all());
        return response()->json($bidangperusahaan,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(BidangPerusahaan $bidangperusahaan)
    {
        return $bidangperusahaan;
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
    public function update(Request $request,BidangPerusahaan $bidangperusahaan)
    {
        $bidangperusahaan->update($request->all());
        return response()->json($bidangperusahaan,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BidangPerusahaan $bidangperusahaan)
    {
        $bidangperusahaan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
