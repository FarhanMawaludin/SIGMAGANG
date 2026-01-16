<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activemenu = 'skill';

        $search = $request->input('search');
        $category = $request->input('category', 'all');

        $query = Skill::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        if ($category !== 'all') {
            $query->where('id', $category);
        }

        $skill = $query->paginate(10)->appends([
            'search' => $search,
            'category' => $category
        ]);
        $skills = Skill::all();
        return view('admin.skill.index', compact('activemenu', 'skill', 'search', 'category','skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activemenu = 'skill';
        return view('admin.skill.create',['activemenu' => $activemenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama wajib diisi.',
        ]);
        try{
        Skill::create($request->all());
        return redirect()->route('skill.index')->with('success', 'Jenis Magang berhasil ditambahkan');
    }catch(\Exception $e){
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan skill.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activemenu = 'skill';
        $skill = Skill::findOrFail($id);
        return view('admin.skill.show',['activemenu' => $activemenu,'skill' => $skill]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activemenu = 'skill';
        $skill = Skill::findOrFail($id);
        return view('admin.skill.edit',['activemenu' => $activemenu,'skill' => $skill]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama wajib diisi.',
        ]);
        try{
        $skill = Skill::findOrFail($id);
        $skill->update($request->all());
        return redirect()->route('skill.index')->with('success', 'Skill berhasil diupdate');
    }catch(\Exception $e){
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate skill.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('skill.index')->with('success', 'Skill berhasil dihapus');
    }
}
