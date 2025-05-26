<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\User; // Assuming you have a User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class DokumenController extends Controller
{
    /**
     * Display a listing of the documents based on user role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $activemenu = 'dokumen'; // Set active menu for sidebar
        $user = $request->user();
        $dokumens = collect(); // Initialize an empty collection
        $viewName = '';

        if (!$user) {
            // Redirect unauthenticated users to login
            return redirect()->route('login'); // Assuming you have a 'login' route
        }

        if ($user->role === 'admin') { // Check role directly
            // Admin can view all documents
            $dokumens = Dokumen::all();
            $viewName = 'admin.dokumen.index';
        } else { // For students/dosen
            // Students/Dosen can only view their own documents
            $dokumens = Dokumen::where('documentable_id', $user->id)
                ->where('documentable_type', $user->role === 'mahasiswa' ? 'mahasiswa' : 'dosen')
                ->get();
            $viewName = 'student.dokumen.index'; // Changed to 'student' for consistency
        }

        return view($viewName, compact('dokumens', 'activemenu'));
    }

    /**
     * Show the form for creating a new document.
     * Only accessible by students/dosen and admins.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $activemenu = 'dokumen'; // Set active menu for sidebar
        $user = Auth::user();

        // Allow creation if user is admin, mahasiswa, or dosen
        if (!$user || !($user->role === 'admin' || $user->role === 'mahasiswa' || $user->role === 'dosen')) {
            return redirect()->route('dokumen.index')->with('error', 'You are not authorized to create documents.');
        }

        // Determine which create view to load based on role
        $viewName = $user->role === 'admin' ? 'admin.dokumen.create' : 'student.dokumen.create'; // Changed to 'student' for consistency
        return view($viewName, compact('activemenu'));
    }

    /**
     * Store multiple newly created documents in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // Allow storing if user is admin, mahasiswa, or dosen
        if (!$user || !($user->role === 'admin' || $user->role === 'mahasiswa' || $user->role === 'dosen')) {
            return redirect()->route('dokumen.index')->with('error', 'You are not authorized to upload documents.');
        }

        // Validate each file and its corresponding type
        $validator = Validator::make($request->all(), [
            'file.*' => 'required|file|max:5120', // 5MB max
            'tipe.*' => 'required|in:CV,Sertifikat,Surat Pengantar,Transkrip Nilai' // Added missing types
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $uploadedCount = 0;

        // Loop through each uploaded file
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $key => $file) {
                // Ensure a file and a type are provided for this index
                if ($file && isset($request->tipe[$key])) {
                    $path = $file->store('dokumen', 'public');

                    Dokumen::create([
                        'documentable_id' => $user->id,
                        'documentable_type' => $user->role === 'mahasiswa' ? 'mahasiswa' : 'dosen',
                        'tipe' => $request->tipe[$key],
                        'file_path' => $path,
                    ]);
                    $uploadedCount++;
                }
            }
        }

        if ($uploadedCount > 0) {
            // Redirect to the appropriate index route based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dokumen.index')->with('success', "$uploadedCount document(s) successfully uploaded.");
            } else {
                return redirect()->route('dokumen.index')->with('success', "$uploadedCount document(s) successfully uploaded."); // Student/Dosen uses base route
            }
        } else {
            return redirect()->back()->with('error', 'No documents were uploaded. Please select at least one file and its type.');
        }
    }

    /**
     * Display the specified document based on user role.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Dokumen $dokumen)
    {
        $activemenu = 'dokumen'; // Set active menu for sidebar
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user is admin or the owner of the document
        if ($user->role === 'admin' || ($user->id === $dokumen->documentable_id && $user->role === $dokumen->documentable_type)) {
            $viewName = $user->role === 'admin' ? 'admin.dokumen.show' : 'student.dokumen.show'; // Changed to 'student' for consistency
            return view($viewName, compact('dokumen', 'activemenu'));
        }

        return redirect()->route('dokumen.index')->with('error', 'You are not authorized to view this document.');
    }

    /**
     * Show the form for editing the specified document based on user role.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Dokumen $dokumen)
    {
        $activemenu = 'dokumen'; // Set active menu for sidebar
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Allow editing if user is admin or the owner of the document
        if ($user->role === 'admin' || ($user->id === $dokumen->documentable_id && $user->role === $dokumen->documentable_type)) {
            // Determine which edit view to load based on role
            $viewName = $user->role === 'admin' ? 'admin.dokumen.edit' : 'student.dokumen.edit'; // Changed to 'student' for consistency
            return view($viewName, compact('dokumen', 'activemenu')); // Pass activemenu
        }

        return redirect()->route('dokumen.index')->with('error', 'You are not authorized to edit this document.');
    }

    /**
     * Update the specified document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Allow updating if user is admin or the owner of the document
        if (!($user->role === 'admin' || ($user->id === $dokumen->documentable_id && $user->role === $dokumen->documentable_type))) {
            return redirect()->route('dokumen.index')->with('error', 'You are not authorized to update this document.');
        }

        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file|max:5120', // 'nullable' allows no file to be uploaded for update
            'tipe' => 'required|in:CV,Sertifikat,Transkrip Nilai',
            'documentable_type' => 'required|string', // Ensure documentable_type is present and valid
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            // Delete old file if it exists and its path is not null
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $file = $request->file('file');
            $path = $file->store('dokumen', 'public');
            $dokumen->file_path = $path;
        }

        $dokumen->tipe = $request->tipe;
        $dokumen->documentable_type = $request->input('documentable_type'); // Get documentable_type from the request
        $dokumen->save();

        // Redirect to the appropriate index route based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dokumen.index')->with('success', 'Document successfully updated.');
        } else {
            return redirect()->route('dokumen.index')->with('success', 'Document successfully updated.');
        }
    }

    /**
     * Remove the specified document from storage.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dokumen $dokumen)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Allow deleting if user is admin or the owner of the document
        if (!($user->role === 'admin' || ($user->id === $dokumen->documentable_id && $user->role === $dokumen->documentable_type))) {
            return redirect()->route('dokumen.index')->with('error', 'You are not authorized to delete this document.');
        }

        // Delete file if it exists and its path is not null
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) { // Added null check for file_path
            Storage::disk('public')->delete($dokumen->file_path);
        }
        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Document successfully deleted.');
    }
}
