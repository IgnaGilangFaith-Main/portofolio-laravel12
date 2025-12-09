<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Exception;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    private function prosesFoto($file, $oldFile = null)
    {
        if (! $file) {
            return $oldFile;
        }

        try {
            // sanitasi nama file untuk keamanan
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'_'.preg_replace('/[^a-zA-Z0-9_-]/', '', $originalName).'.'.$extension;

            // pastikan folder exists
            $uploadPath = public_path('img/hero');
            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // pindah file ke folder public/img/hero
            $file->move(public_path('img/hero'), $fileName);

            // hapus file lama SETELAH upload berhasil + basename
            if ($oldFile && file_exists(public_path('img/hero/'.basename($oldFile)))) {
                try {
                    unlink(public_path('img/hero/'.basename($oldFile)));
                } catch (Exception $e) {
                    \Log::error('Gagal menghapus file lama: '.$e->getMessage(), ['file' => $oldFile]);
                }
            }

            return $fileName;
        } catch (Exception $e) {
            // Log error
            \Log::error('Gagal proses foto: '.$e->getMessage());

            // kembalikan file lama jika ada error
            return $oldFile;
        }
    }

    public function index()
    {
        $heroes = Hero::latest()->get();

        return view('back.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('back.hero.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'moto' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'moto.required' => 'Moto harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'foto.required' => 'Foto harus diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $validated['foto'] = $this->prosesFoto($request->file('foto'));

        // Jika proses foto gagal, kembalikan error
        if (! $validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');

            return back()->withInput();
        }

        try {
            Hero::create($validated);
            sweetalert()->success('Data hero berhasil disimpan.');

            return redirect('/hero');
        } catch (Exception $e) {
            // Jika create gagal, hapus file foto yang sudah diupload
            if ($validated['foto'] && file_exists(public_path('img/hero/'.$validated['foto']))) {
                unlink(public_path('img/hero/'.$validated['foto']));
            }
            \Log::error('Gagal menyimpan hero: '.$e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');

            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);

        return view('back.hero.edit', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'moto' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'moto.required' => 'Moto harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $oldFoto = $hero->foto;
        $validated['foto'] = $this->prosesFoto($request->file('foto'), $hero->foto);

        // Jika proses foto gagal dan ada file baru, kembalikan error
        if ($request->hasFile('foto') && ! $validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');

            return back()->withInput();
        }

        try {
            $hero->update($validated);
            sweetalert()->success('Data hero berhasil diupdate.');

            return redirect('/hero');
        } catch (Exception $e) {
            // Jika update gagal dan ada file baru yang diupload, hapus file baru
            if ($request->hasFile('foto') && $validated['foto'] !== $oldFoto && file_exists(public_path('img/hero/'.$validated['foto']))) {
                unlink(public_path('img/hero/'.$validated['foto']));
            }
            \Log::error('Gagal mengupdate hero: '.$e->getMessage());
            sweetalert()->error('Gagal mengupdate data.');

            return back()->withInput();
        }
    }

    public function delete($id)
    {
        $hero = Hero::findOrFail($id);

        return view('back.hero.delete', compact('hero'));
    }

    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);

        try {
            $hero->delete();

            // Hapus foto SETELAH delete berhasil
            if ($hero->foto) {
                $filePath = public_path('img/hero/'.basename($hero->foto));
                if (file_exists($filePath) && is_file($filePath)) {
                    try {
                        unlink($filePath);
                    } catch (Exception $e) {
                        \Log::error('Gagal menghapus foto hero setelah delete: '.$e->getMessage(), [
                            'file' => $hero->foto,
                        ]);
                    }
                }
            }

            sweetalert()->success('Data hero berhasil dihapus.');

            return redirect('/hero');
        } catch (Exception $e) {
            \Log::error('Gagal menghapus hero: '.$e->getMessage());
            sweetalert()->error('Gagal menghapus data.');

            return back();
        }
    }
}
