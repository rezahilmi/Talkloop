<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kategori;
use App\Models\Pertanyaan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $kategoris = Kategori::all();
        $kumpulanPertanyaan = Pertanyaan::with(['user', 'kategori', 'jawaban'])->latest()->get();
        return view('forum', compact('kumpulanPertanyaan', 'kategoris'));
    }

    public function show($id)
    {
        $kategoris = Kategori::all();
        $pertanyaan = Pertanyaan::with(['user', 'kategori', 'jawaban'])->findOrFail($id);
        return view('pertanyaan', compact('pertanyaan', 'kategoris'));
    }
    public function showKategori()
    {
        $kategoris = Kategori::all();
        return view('kategori', compact('kategoris'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil dibuat!');
    }

    public function updateKategori(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori->update(['kategori' => $request->kategori]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('show.kategori')->with('success', 'Kategori berhasil dihapus.');
    }

    public function create()
    {
        return view('forum.create');
    }

    public function storePertanyaan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar', 'public');
        }

        Pertanyaan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $request->kategori,
            'gambar' => $gambarPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Pertanyaan berhasil dibuat!');
    }

    public function updatePertanyaan(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $this->authorize('update', $pertanyaan);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|integer',
            'gambar' => 'image',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_pertanyaan', 'public');
            $pertanyaan->gambar = $gambarPath;
        }

        $pertanyaan->judul = $request->judul;
        $pertanyaan->isi = $request->isi;
        $pertanyaan->kategori_id = $request->kategori;
        $pertanyaan->user_id = Auth::id();

        $pertanyaan->save();

        return redirect()->route('pertanyaan', $id)->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    public function destroyPertanyaan($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $this->authorize('delete', $pertanyaan);
        $pertanyaan->delete();

        return redirect()->route('forum')->with('success', 'Pertanyaan berhasil dihapus.');
    }

    public function storeJawaban(Request $request, $pertanyaan_id)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        Jawaban::create([
            'jawaban' => $request->jawaban,
            'pertanyaan_id' => $pertanyaan_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Jawaban berhasil dikirim!');
    }

    public function updateJawaban(Request $request, $id)
    {
        $answer = Jawaban::findOrFail($id);
        $this->authorize('update', $answer);

        $request->validate(['jawaban' => 'required|string']);
        $answer->update(['jawaban' => $request->jawaban]);

        return redirect()->back()->with('success', 'Jawaban berhasil diperbarui!');
    }

    public function destroyJawaban($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $this->authorize('delete', $jawaban);

        $jawaban->delete();

        return back()->with('success', 'Jawaban berhasil dihapus.');
    }
}
