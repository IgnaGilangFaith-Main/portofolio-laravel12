<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('id')->get();

        return view('back.skill.index', compact('skills'));
    }

    public function create()
    {
        return view('back.skill.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama skill harus diisi.',
        ]);

        try {
            Skill::create($validated);
            sweetalert()->success('Skill berhasil ditambahkan.');

            return redirect('/skill');
        } catch (Exception $e) {
            \Log::error('Gagal menyimpan skill: '.$e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');

            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);

        return view('back.skill.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama skill harus diisi.',
        ]);

        try {
            $skill->update($validated);
            sweetalert()->success('Skill berhasil diupdate.');

            return redirect('/skill');
        } catch (Exception $e) {
            \Log::error('Gagal mengupdate skill: '.$e->getMessage());
            sweetalert()->error('Gagal mengupdate data.');

            return back()->withInput();
        }
    }

    public function delete($id)
    {
        $skill = Skill::findOrFail($id);

        return view('back.skill.delete', compact('skill'));
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);

        try {
            $skill->delete();
            sweetalert()->success('Skill berhasil dihapus.');

            return redirect('/skill');
        } catch (Exception $e) {
            \Log::error('Gagal menghapus skill: '.$e->getMessage());
            sweetalert()->error('Gagal menghapus data.');

            return back();
        }
    }
}
