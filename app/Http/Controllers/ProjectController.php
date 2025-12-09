<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
            $uploadPath = public_path('img/project');
            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // pindah file ke folder public/img/project
            $file->move(public_path('img/project'), $fileName);

            // hapus file lama SETELAH upload berhasil + basename
            if ($oldFile && file_exists(public_path('img/project/'.basename($oldFile)))) {
                try {
                    unlink(public_path('img/project/'.basename($oldFile)));
                } catch (Exception $e) {
                    \Log::error('Gagal menghapus file lama: '.$e->getMessage(), ['file' => $oldFile]);
                    // Opsional: throw exception jika ingin hentikan proses
                }
            }

            return $fileName;
        } catch (Exception $e) {
            // Log error (optional tapi sangat direkomendasikan)
            \Log::error('Gagal proses foto: '.$e->getMessage());

            // kembalikan file lama jika ada error
            return $oldFile;
        }
    }

    public function index()
    {
        $projects = Project::latest()->get();

        return view('back.project.index', compact('projects'));
    }

    public function create()
    {
        return view('back.project.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_proyek' => 'required|string|max:255',
            'deskripsi_proyek' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url|max:255',
        ], [
            'judul_proyek.required' => 'Judul proyek harus diisi.',
            'deskripsi_proyek.required' => 'Deskripsi proyek harus diisi.',
            'foto.required' => 'Foto harus diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'link.url' => 'Format link tidak valid.',
        ]);

        $validated['foto'] = $this->prosesFoto($request->file('foto'));

        // Jika proses foto gagal, kembalikan error
        if (! $validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');

            return back()->withInput();
        }

        try {
            Project::create($validated);
            sweetalert()->success('Project berhasil ditambahkan.');

            return redirect('/project');
        } catch (Exception $e) {
            // Jika create gagal, hapus file foto yang sudah diupload
            if ($validated['foto'] && file_exists(public_path('img/project/'.$validated['foto']))) {
                unlink(public_path('img/project/'.$validated['foto']));
            }
            \Log::error('Gagal menyimpan project: '.$e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');

            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('back.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'judul_proyek' => 'required|string|max:255',
            'deskripsi_proyek' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url|max:255',
        ], [
            'judul_proyek.required' => 'Judul proyek harus diisi.',
            'deskripsi_proyek.required' => 'Deskripsi proyek harus diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'link.url' => 'Format link tidak valid.',
        ]);

        $validated['foto'] = $this->prosesFoto($request->file('foto'), $project->foto);

        // Jika proses foto gagal dan ada file baru, kembalikan error
        if ($request->hasFile('foto') && ! $validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');

            return back()->withInput();
        }

        try {
            $project->update($validated);
            sweetalert()->success('Project berhasil diupdate.');

            return redirect('/project');
        } catch (Exception $e) {
            // Jika update gagal dan ada file baru yang diupload, hapus file baru
            if ($request->hasFile('foto') && $validated['foto'] !== $project->foto && file_exists(public_path('img/project/'.$validated['foto']))) {
                unlink(public_path('img/project/'.$validated['foto']));
            }
            \Log::error('Gagal mengupdate project: '.$e->getMessage());
            sweetalert()->error('Gagal mengupdate data.');

            return back()->withInput();
        }
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);

        return view('back.project.delete', compact('project'));
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        try {
            $project->delete();

            // Hapus foto SETELAH delete berhasil
            if ($project->foto) {
                $filePath = public_path('img/project/'.basename($project->foto));
                if (file_exists($filePath) && is_file($filePath)) {
                    try {
                        unlink($filePath);
                    } catch (Exception $e) {
                        \Log::error('Gagal menghapus foto project setelah delete: '.$e->getMessage(), [
                            'file' => $project->foto,
                        ]);
                    }
                }
            }

            sweetalert()->success('Project berhasil dihapus.');

            return redirect('/project');
        } catch (Exception $e) {
            \Log::error('Gagal menghapus project: '.$e->getMessage());
            sweetalert()->error('Gagal menghapus data.');

            return back();
        }
    }
}
