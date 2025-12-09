<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $skills = Skill::orderBy('id')->get();

        if (! $about) {
            sweetalert()->warning('Data about belum ada. Silakan tambahkan data about terlebih dahulu.');
        }

        return view('back.about.index', compact('about', 'skills'));
    }

    public function create()
    {
        return view('back.about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pendidikan' => 'nullable|string|max:255',
            'gpa' => 'nullable|string|max:10',
            'lokasi' => 'nullable|string|max:255',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
        ]);

        try {
            About::create($validated);
            sweetalert()->success('Data about berhasil ditambahkan.');

            return redirect('/about');
        } catch (Exception $e) {
            \Log::error('Gagal menyimpan about: '.$e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');

            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);

        return view('back.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pendidikan' => 'nullable|string|max:255',
            'gpa' => 'nullable|string|max:10',
            'lokasi' => 'nullable|string|max:255',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
        ]);

        try {
            $about->update($validated);
            sweetalert()->success('Data about berhasil diupdate.');

            return redirect('/about');
        } catch (Exception $e) {
            \Log::error('Gagal mengupdate about: '.$e->getMessage());
            sweetalert()->error('Gagal mengupdate data.');

            return back()->withInput();
        }
    }

    public function delete($id)
    {
        $about = About::findOrFail($id);

        return view('back.about.delete', compact('about'));
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);

        try {
            $about->delete();
            sweetalert()->success('Data about berhasil dihapus.');

            return redirect('/about');
        } catch (Exception $e) {
            \Log::error('Gagal menghapus about: '.$e->getMessage());
            sweetalert()->error('Gagal menghapus data.');

            return back();
        }
    }
}
