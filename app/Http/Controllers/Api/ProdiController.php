<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(){
        return response()->json(Prodi::all());
    }
    public function create(){

    }
    public function store(Request $request){
        $prodi = Prodi::create($request->only('nama_prodi'));
        return response()->json($prodi,200);
    }
    public function show(Prodi $prodi){
        return $prodi;
    }
    public function update(Request $request,Prodi $prodi){
        $prodi->update($request->only('nama_prodi'));
        return response()->json($prodi,200);
    }
    public function destroy(Prodi $prodi){
        $prodi->delete();
   
           return response()->json([
               'success' => true,
               'message' => 'Data Terhapus',
           ]);
    }
    
}
