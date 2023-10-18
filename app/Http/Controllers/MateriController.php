<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $materis = Materi::latest()->paginate(5);
            return view('admin.materi.index', compact('materis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul'     =>  'required|',
            'isi'       =>  'required|',
            'gif'       =>  'required|image|mimes:gif',
        ]);

        //upload image
        $gif = $request->file('gif');
        $gif->storeAs('public/mapels', $gif->hashName());

        //create post
        Materi::create([
            'judul'     => $request->judul,
            'isi'       => $request->isi,
            'gif'       => $gif->hashName(),
        ]);

        return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        $this->validate($request, [
            'judul'     =>  'required|',
            'isi'       =>  'required|',
            'gif'       =>  'required|image|mimes:gif',
        ]);

        //untuk menyimpan gambar yang ada
        $existingGif = $materi->gif;

        if ($request->hasFile('gif')) {
            $gif = $request->file('gif');
            $gif ->storeAs('public/materis', $gif->hashName());

            //hapus gambar lama
            if ($existingGif) {
                Storage::delete('public/materis/' . $existingGif);
            }

            $materi->update([
                'judul'     => $request->judul,
                'isi'       => $request->isi,
                'gif'       => $gif->hashName(),
            ]);
        } else {
            $materi->update([
                'judul'     => $request->judul,
                'isi'       => $request->isi,
                'gif'       => $existingGif //gunakan gif yang sudah ada
            ]);
        }

        return redirect()->route('materi.index')->with(['success' => "Data Berhasil di Update!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        Storage::delete('public/materis/', $materi->gif);
        $materi->delete();
        return redirect()->route('materi.index')-> with(['successsss' => 'Data sudah dihapus']);
    }
}