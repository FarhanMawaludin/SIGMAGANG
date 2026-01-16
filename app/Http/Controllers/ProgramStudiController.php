<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        $activemenu = 'programstudi';

        $search = $request->input('search');
        $category = $request->input('category', 'all'); 

        $query = Prodi::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        if ($category !== 'all') {
            $query->where('id', $category);
        }

        $programstudi = $query->paginate(10);

        $programstudi->appends(['search' => $search, 'category' => $category]);
        $prodis = Prodi::all();
        return view('admin.programstudi.index', [
            'activemenu' => $activemenu,
            'programstudi' => $programstudi,
            'category' => $category, 
            'search' => $search,     
            'prodis' => $prodis
        ]);
    }
    public function create()
    {
        $activemenu = 'programstudi';
        return view('admin.programstudi.create',['activemenu' => $activemenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama wajib diisi.',
        ]);
        try{
        Prodi::create($request->all());
        return redirect()->route('programstudi.index')->with('success', 'Program Studi berhasil ditambahkan');
    }catch(\Exception $e){
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan program studi.');
    }
    }
    public function edit($id)
    {
        $activemenu = 'programstudi';
        $programstudi = Prodi::findOrFail($id);
        return view('admin.programstudi.edit',['activemenu' => $activemenu,'programstudi' => $programstudi]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama wajib diisi.',
        ]);
        try{
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());
        return redirect()->route('programstudi.index')->with('success', 'Program Studi berhasil diupdate');
    }catch(\Exception $e){
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate program studi.');
    }
    }
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();
        return redirect()->route('programstudi.index')->with('success', 'Program Studi berhasil dihapus');
    }
}
