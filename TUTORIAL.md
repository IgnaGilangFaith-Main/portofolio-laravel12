# Tutorial: Membuat Project Portofolio Laravel dari Awal

Panduan lengkap untuk membuat aplikasi portofolio Laravel dengan fitur Hero, About, Skills, Projects, dan User Management.

## Persyaratan Sistem

-   PHP 8.2+
-   Composer
-   MySQL atau database lainnya
-   Git

## Langkah 1: Instalasi Laravel

1. Install Laravel via Composer:

    ```bash
    composer create-project laravel/laravel portofolio-laravel12
    cd portofolio-laravel12
    ```

2. Setup environment:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. Konfigurasi database di `.env`:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=portofolio_laravel12
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

4. Install SweetAlert PHP Flasher:
    ```bash
    composer require php-flasher/flasher-sweetalert-laravel
    php artisan flasher:install
    ```

## Langkah 2: Setup Authentication

Gunakan AuthController untuk login dan logout custom.

1. Buat AuthController:

    ```bash
    php artisan make:controller AuthController
    ```

2. Kode AuthController:

    ```php
    <?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class AuthController extends Controller
    {
        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ], [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password harus diisi.',
                'password.string' => 'Format password tidak valid.',
            ]);

            try {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    sweetalert()->info('Selamat datang ' . Auth::user()->name . '!');

                    return redirect()->intended('/dashboard');
                } else {
                    sweetalert()->error('Login Gagal! Email atau Password Salah!');
                    return redirect('/login')->withInput($request->only('email'));
                }
            } catch (Exception $e) {
                \Log::error('Error saat login: ' . $e->getMessage());
                sweetalert()->error('Terjadi kesalahan saat login. Silakan coba lagi.');
                return redirect('/login')->withInput($request->only('email'));
            }
        }

        public function logout(Request $request)
        {
            try {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();
                sweetalert()->success('Anda telah logout.');

                return redirect('/login');
            } catch (Exception $e) {
                \Log::error('Error saat logout: ' . $e->getMessage());
                sweetalert()->error('Terjadi kesalahan saat logout.');
                return redirect('/dashboard');
            }
        }
    }
    ```

3. Buat views untuk login: `resources/views/auth/login.blade.php`

4. Routing untuk auth:
    ```php
    Route::get('/login', function () { return view('auth.login'); });
    Route::post('/login', [AuthController::class, 'login']);
    ```

Atau gunakan Laravel Breeze/Jetstream jika lebih mudah.

## Langkah 3: Membuat Model dan Migration

### Hero Model

```bash
php artisan make:model Hero -m
```

Edit migration `database/migrations/xxxx_create_hero_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('moto');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('heroes');
    }
};
```

Edit model `app/Models/Hero.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['nama', 'moto', 'deskripsi', 'foto'];
}
```

### About Model

```bash
php artisan make:model About -m
```

Migration `database/migrations/xxxx_create_about_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('pendidikan')->nullable();
            $table->string('gpa')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};
```

Model `app/Models/About.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'pendidikan', 'gpa', 'lokasi'];
}
```

### Skill Model

```bash
php artisan make:model Skill -m
```

Migration `database/migrations/xxxx_create_skills_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skills');
    }
};
```

Model `app/Models/Skill.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['nama'];
}
```

### Project Model

```bash
php artisan make:model Project -m
```

Migration `database/migrations/xxxx_create_project_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('judul_proyek');
            $table->text('deskripsi_proyek');
            $table->string('foto')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
```

Model `app/Models/Project.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['judul_proyek', 'deskripsi_proyek', 'foto', 'link'];
}
```

Jalankan migration:

```bash
php artisan migrate
```

## Langkah 4: Membuat Controller

### HomepageController

```bash
php artisan make:controller HomepageController
```

Kode `app/Http/Controllers/HomepageController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Hero;
use App\Models\Project;
use App\Models\Skill;

class HomepageController extends Controller
{
    public function index()
    {
        $heroes = Hero::latest()->get();
        $abouts = About::latest()->get();
        $skills = Skill::oldest()->get();
        $projects = Project::latest()->get();

        return view('front.index', compact('heroes', 'abouts', 'skills', 'projects'));
    }
}
```

### HeroController

```bash
php artisan make:controller HeroController --resource
```

Kode lengkap `app/Http/Controllers/HeroController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Exception;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    private function prosesFoto($file, $oldFile = null)
    {
        if (!$file) {
            return $oldFile;
        }

        try {
            // sanitasi nama file untuk keamanan
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $originalName) . '.' . $extension;

            // pastikan folder exists
            $uploadPath = public_path('img/hero');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // pindah file ke folder public/img/hero
            $file->move(public_path('img/hero'), $fileName);

            // hapus file lama SETELAH upload berhasil + basename
            if ($oldFile && file_exists(public_path('img/hero/' . basename($oldFile)))) {
                try {
                    unlink(public_path('img/hero/' . basename($oldFile)));
                } catch (Exception $e) {
                    \Log::error('Gagal menghapus file lama: ' . $e->getMessage(), ['file' => $oldFile]);
                    // Opsional: throw exception jika ingin hentikan proses
                }
            }

            return $fileName;
        } catch (Exception $e) {
            // Log error
            \Log::error('Gagal proses foto: ' . $e->getMessage());
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
        if (!$validated['foto']) {
            return back()->withErrors(['foto' => 'Gagal memproses foto.'])->withInput();
        }

        try {
            Hero::create($validated);
            sweetalert()->success('Data hero berhasil disimpan.');
            return redirect('/hero');
        } catch (Exception $e) {
            // Jika create gagal, hapus file foto yang sudah diupload
            if ($validated['foto'] && file_exists(public_path('img/hero/' . $validated['foto']))) {
                unlink(public_path('img/hero/' . $validated['foto']));
            }
            \Log::error('Gagal menyimpan hero: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal menyimpan data hero.'])->withInput();
        }
    }

    public function show($id)
    {
        //
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
        if ($request->hasFile('foto') && !$validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');
            return back()->withInput();
        }

        try {
            $hero->update($validated);
            sweetalert()->success('Data hero berhasil diupdate.');
            return redirect('/hero');
        } catch (Exception $e) {
            // Jika update gagal dan ada file baru yang diupload, hapus file baru
            if ($request->hasFile('foto') && $validated['foto'] !== $oldFoto && file_exists(public_path('img/hero/' . $validated['foto']))) {
                unlink(public_path('img/hero/' . $validated['foto']));
            }
            \Log::error('Gagal mengupdate hero: ' . $e->getMessage());
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
                $filePath = public_path('img/hero/' . basename($hero->foto));
                if (file_exists($filePath) && is_file($filePath)) {
                    try {
                        unlink($filePath);
                    } catch (Exception $e) {
                        \Log::error('Gagal menghapus foto hero setelah delete: ' . $e->getMessage(), [
                            'file' => $hero->foto,
                        ]);
                    }
                }
            }

            sweetalert()->success('Data hero berhasil dihapus.');
            return redirect('/hero');
        } catch (Exception $e) {
            \Log::error('Gagal menghapus hero: ' . $e->getMessage());
            sweetalert()->error('Gagal menghapus data.');
            return back();
        }
    }
}
```

### AboutController

```bash
php artisan make:controller AboutController --resource
```

Kode lengkap `app/Http/Controllers/AboutController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\About;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $skills = Skill::orderBy('id')->get();

        if (!$about) {
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
            \Log::error('Gagal menyimpan about: ' . $e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');
            return back()->withInput();
        }
    }

    public function show($id)
    {
        //
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
            \Log::error('Gagal mengupdate about: ' . $e->getMessage());
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
            \Log::error('Gagal menghapus about: ' . $e->getMessage());
            sweetalert()->error('Gagal menghapus data.');
            return back();
        }
    }
}
```

### SkillController

```bash
php artisan make:controller SkillController --resource
```

Kode lengkap `app/Http/Controllers/SkillController.php`:

```php
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
            \Log::error('Gagal menyimpan skill: ' . $e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');
            return back()->withInput();
        }
    }

    public function show($id)
    {
        //
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
            \Log::error('Gagal mengupdate skill: ' . $e->getMessage());
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
            \Log::error('Gagal menghapus skill: ' . $e->getMessage());
            sweetalert()->error('Gagal menghapus data.');
            return back();
        }
    }
}
```

### ProjectController

```bash
php artisan make:controller ProjectController --resource
```

Kode lengkap `app/Http/Controllers/ProjectController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private function prosesFoto($file, $oldFile = null)
    {
        if (!$file) {
            return $oldFile;
        }

        try {
            // sanitasi nama file untuk keamanan
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $originalName) . '.' . $extension;

            // pastikan folder exists
            $uploadPath = public_path('img/project');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // pindah file ke folder public/img/project
            $file->move(public_path('img/project'), $fileName);

            // hapus file lama SETELAH upload berhasil + basename
            if ($oldFile && file_exists(public_path('img/project/' . basename($oldFile)))) {
                try {
                    unlink(public_path('img/project/' . basename($oldFile)));
                } catch (Exception $e) {
                    \Log::error('Gagal menghapus file lama: ' . $e->getMessage(), ['file' => $oldFile]);
                    // Opsional: throw exception jika ingin hentikan proses
                }
            }

            return $fileName;
        } catch (Exception $e) {
            // Log error
            \Log::error('Gagal proses foto: ' . $e->getMessage());
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
        if (!$validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');
            return back()->withInput();
        }

        try {
            Project::create($validated);
            sweetalert()->success('Project berhasil ditambahkan.');
            return redirect('/project');
        } catch (Exception $e) {
            // Jika create gagal, hapus file foto yang sudah diupload
            if ($validated['foto'] && file_exists(public_path('img/project/' . $validated['foto']))) {
                unlink(public_path('img/project/' . $validated['foto']));
            }
            \Log::error('Gagal menyimpan project: ' . $e->getMessage());
            sweetalert()->error('Gagal menyimpan data.');
            return back()->withInput();
        }
    }

    public function show($id)
    {
        //
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
        if ($request->hasFile('foto') && !$validated['foto']) {
            sweetalert()->error('Gagal mengunggah foto.');
            return back()->withInput();
        }

        try {
            $project->update($validated);
            sweetalert()->success('Project berhasil diupdate.');
            return redirect('/project');
        } catch (Exception $e) {
            // Jika update gagal dan ada file baru yang diupload, hapus file baru
            if ($request->hasFile('foto') && $validated['foto'] !== $project->foto && file_exists(public_path('img/project/' . $validated['foto']))) {
                unlink(public_path('img/project/' . $validated['foto']));
            }
            \Log::error('Gagal mengupdate project: ' . $e->getMessage());
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
                $filePath = public_path('img/project/' . basename($project->foto));
                if (file_exists($filePath) && is_file($filePath)) {
                    try {
                        unlink($filePath);
                    } catch (Exception $e) {
                        \Log::error('Gagal menghapus foto project setelah delete: ' . $e->getMessage(), [
                            'file' => $project->foto,
                        ]);
                    }
                }
            }

            sweetalert()->success('Project berhasil dihapus.');
            return redirect('/project');
        } catch (Exception $e) {
            \Log::error('Gagal menghapus project: ' . $e->getMessage());
            sweetalert()->error('Gagal menghapus data.');
            return back();
        }
    }
}
```

### UserController

```bash
php artisan make:controller UserController
```

Kode lengkap `app/Http/Controllers/UserController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = Auth::user();

        return view('back.user.index', compact('data'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('back.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'new_password' => 'nullable|min:6',
            'new_password_confirmation' => 'nullable|same:new_password|required_with:new_password',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email harus berformat email!',
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain!',
            'new_password.min' => 'Password harus minimal :min karakter!',
            'new_password_confirmation.same' => 'Konfirmasi password harus sama dengan password baru!',
            'new_password_confirmation.required_with' => 'Konfirmasi password wajib diisi jika password baru diisi!',
        ]);

        $user = User::findOrFail($id);

        $email_verified = $user->email_verified_at ? $user->email_verified_at : Carbon::now();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $email_verified,
            'password' => $request->new_password ? bcrypt($request->new_password) : $user->password,
        ];

        try {
            $user->update($data);
            sweetalert()->success('Data berhasil diupdate!');
            return redirect('/pengaturan-akun');
        } catch (Exception $e) {
            \Log::error('Gagal mengupdate user: ' . $e->getMessage());
            sweetalert()->error('Gagal mengupdate data.');
            return back()->withInput();
        }
    }
}
```

### AuthController

Sudah di Langkah 2.

## Langkah 4.5: Middleware

Laravel sudah menyediakan middleware `auth` secara default untuk melindungi route yang memerlukan autentikasi. Middleware ini akan mengarahkan pengguna yang belum login ke halaman login.

Jika Anda ingin membuat middleware custom, gunakan perintah:

```bash
php artisan make:middleware IsLoggedIn
```

Contoh kode middleware custom (opsional, jika diperlukan):

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            sweetalert()->error('Anda harus login terlebih dahulu.');

            return redirect('/login');
        }

        return $next($request);
    }
}
```

Daftarkan middleware di `app/Http/Kernel.php` atau `bootstrap/app.php` (untuk Laravel 11+):

```php
protected $routeMiddleware = [
    // ...
    'is_logged_in' => \App\Http\Middleware\IsLoggedIn::class,
];
```

Untuk project ini, cukup gunakan middleware `auth` yang sudah tersedia.

## Langkah 5: Routing

Edit `routes/web.php` dengan kode lengkap:

```php
<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomepageController::class, 'index']);

// Auth Routes
Route::get('/login', function () {
    return view('back.login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout']);

    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return view('back.dashboard');
        });
    });

    // Hero Routes
    Route::get('/hero', [HeroController::class, 'index']);
    Route::get('/hero/create', [HeroController::class, 'create']);
    Route::post('/hero/create', [HeroController::class, 'store']);
    Route::get('/hero/{id}/edit', [HeroController::class, 'edit']);
    Route::put('/hero/{id}/update', [HeroController::class, 'update']);
    Route::get('/hero/{id}/delete', [HeroController::class, 'delete']);
    Route::delete('/hero/{id}/delete', [HeroController::class, 'destroy']);

    // About Routes
    Route::get('/about', [AboutController::class, 'index']);
    Route::get('/about/create', [AboutController::class, 'create']);
    Route::post('/about/create', [AboutController::class, 'store']);
    Route::get('/about/{id}/edit', [AboutController::class, 'edit']);
    Route::put('/about/{id}/update', [AboutController::class, 'update']);
    Route::get('/about/{id}/delete', [AboutController::class, 'delete']);
    Route::delete('/about/{id}/delete', [AboutController::class, 'destroy']);

    // Skill Routes
    Route::get('/skill', [SkillController::class, 'index']);
    Route::get('/skill/create', [SkillController::class, 'create']);
    Route::post('/skill/create', [SkillController::class, 'store']);
    Route::get('/skill/{id}/edit', [SkillController::class, 'edit']);
    Route::put('/skill/{id}/update', [SkillController::class, 'update']);
    Route::get('/skill/{id}/delete', [SkillController::class, 'delete']);
    Route::delete('/skill/{id}/delete', [SkillController::class, 'destroy']);

    // Project Routes
    Route::get('/project', [ProjectController::class, 'index']);
    Route::get('/project/create', [ProjectController::class, 'create']);
    Route::post('/project/create', [ProjectController::class, 'store']);
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit']);
    Route::put('/project/{id}/update', [ProjectController::class, 'update']);
    Route::get('/project/{id}/delete', [ProjectController::class, 'delete']);
    Route::delete('/project/{id}/delete', [ProjectController::class, 'destroy']);

    // User Routes (Pengaturan Akun)
    Route::get('/pengaturan-akun', [UserController::class, 'index']);
    Route::get('/pengaturan-akun/{id}/edit', [UserController::class, 'edit']);
    Route::put('/pengaturan-akun/{id}/update', [UserController::class, 'update']);

});

```

## Langkah 6: Membuat Views

### Layout

Buat `resources/views/layouts/app.blade.php`:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
```

Buat `resources/views/layouts/navbar.blade.php`:

```php
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Portfolio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                        Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/hero">Hero</a></li>
                        <li><a class="dropdown-item" href="/about">About</a></li>
                        <li><a class="dropdown-item" href="/skill">Skills</a></li>
                        <li><a class="dropdown-item" href="/project">Projects</a></li>
                        <li><a class="dropdown-item" href="/pengaturan-akun">Account</a></li>
                    </ul>
                </li>
                @endauth
            </ul>
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                @else
                <li class="nav-item">
                    <form method="POST" action="/logout" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
```

### Front Views

`resources/views/front/index.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
    @foreach($heroes as $hero)
    <div class="col-md-12 mb-4">
        <div class="card">
            <img src="{{ asset('img/hero/' . $hero->foto) }}" class="card-img-top" alt="{{ $hero->nama }}">
            <div class="card-body">
                <h5 class="card-title">{{ $hero->nama }}</h5>
                <p class="card-text">{{ $hero->moto }}</p>
                <p class="card-text">{{ $hero->deskripsi }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    @foreach($abouts as $about)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $about->judul }}</h5>
                <p class="card-text">{{ $about->deskripsi }}</p>
                @if($about->pendidikan)
                <p><strong>Pendidikan:</strong> {{ $about->pendidikan }}</p>
                @endif
                @if($about->gpa)
                <p><strong>GPA:</strong> {{ $about->gpa }}</p>
                @endif
                @if($about->lokasi)
                <p><strong>Lokasi:</strong> {{ $about->lokasi }}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <h3>Skills</h3>
        <ul class="list-group">
            @foreach($skills as $skill)
            <li class="list-group-item">{{ $skill->nama }}</li>
            @endforeach
        </ul>
    </div>
</div>

<div class="row">
    @foreach($projects as $project)
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('img/project/' . $project->foto) }}" class="card-img-top" alt="{{ $project->judul_proyek }}">
            <div class="card-body">
                <h5 class="card-title">{{ $project->judul_proyek }}</h5>
                <p class="card-text">{{ $project->deskripsi_proyek }}</p>
                @if($project->link)
                <a href="{{ $project->link }}" class="btn btn-primary" target="_blank">View Project</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
```

### Back Views

`resources/views/back/hero/index.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Manage Hero')

@section('content')
<h1>Hero Management</h1>
<a href="{{ url('/hero/create') }}" class="btn btn-primary mb-3">Add Hero</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Moto</th>
            <th>Foto</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($heroes as $hero)
        <tr>
            <td>{{ $hero->id }}</td>
            <td>{{ $hero->nama }}</td>
            <td>{{ $hero->moto }}</td>
            <td><img src="{{ asset('img/hero/' . $hero->foto) }}" width="50" alt=""></td>
            <td>
                <a href="{{ url('/hero/' . $hero->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/hero/' . $hero->id . '/delete') }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
```

`resources/views/back/hero/create.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Add Hero')

@section('content')
<h1>Add Hero</h1>
<form action="{{ url('/hero/create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="moto" class="form-label">Moto</label>
        <input type="text" class="form-control" id="moto" name="moto" value="{{ old('moto') }}" required>
        @error('moto') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        @error('foto') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
```

`resources/views/back/hero/edit.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Edit Hero')

@section('content')
<h1>Edit Hero</h1>
<form action="{{ url('/hero/' . $hero->id . '/update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $hero->nama) }}" required>
        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="moto" class="form-label">Moto</label>
        <input type="text" class="form-control" id="moto" name="moto" value="{{ old('moto', $hero->moto) }}" required>
        @error('moto') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $hero->deskripsi) }}</textarea>
        @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        @if($hero->foto)
        <img src="{{ asset('img/hero/' . $hero->foto) }}" width="100" alt="">
        @endif
        @error('foto') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
```

`resources/views/back/hero/delete.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Delete Hero')

@section('content')
<h1>Delete Hero</h1>
<p>Are you sure you want to delete this hero?</p>
<p><strong>{{ $hero->nama }}</strong></p>
<form action="{{ url('/hero/' . $hero->id . '/delete') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="{{ url('/hero') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
```

### About Views

`resources/views/back/about/index.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Manage About')

@section('content')
<h1>About Management</h1>
@if($about)
<a href="{{ url('/about/' . $about->id . '/edit') }}" class="btn btn-warning mb-3">Edit About</a>
<a href="{{ url('/about/' . $about->id . '/delete') }}" class="btn btn-danger mb-3">Delete About</a>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $about->judul }}</h5>
        <p class="card-text">{{ $about->deskripsi }}</p>
        @if($about->pendidikan)
        <p><strong>Pendidikan:</strong> {{ $about->pendidikan }}</p>
        @endif
        @if($about->gpa)
        <p><strong>GPA:</strong> {{ $about->gpa }}</p>
        @endif
        @if($about->lokasi)
        <p><strong>Lokasi:</strong> {{ $about->lokasi }}</p>
        @endif
    </div>
</div>
@else
<a href="{{ url('/about/create') }}" class="btn btn-primary mb-3">Add About</a>
<p>No about data found.</p>
@endif

<h3>Skills</h3>
<a href="/skill" class="btn btn-secondary mb-3">Manage Skills</a>
<ul class="list-group">
    @foreach($skills as $skill)
    <li class="list-group-item">{{ $skill->nama }}</li>
    @endforeach
</ul>
@endsection
```

`resources/views/back/about/create.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Add About')

@section('content')
<h1>Add About</h1>
<form action="{{ url('/about/create') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
        @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="pendidikan" class="form-label">Pendidikan</label>
        <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}">
        @error('pendidikan') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="gpa" class="form-label">GPA</label>
        <input type="text" class="form-control" id="gpa" name="gpa" value="{{ old('gpa') }}">
        @error('gpa') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
        @error('lokasi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
```

`resources/views/back/about/edit.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Edit About')

@section('content')
<h1>Edit About</h1>
<form action="{{ url('/about/' . $about->id . '/update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $about->judul) }}" required>
        @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $about->deskripsi) }}</textarea>
        @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="pendidikan" class="form-label">Pendidikan</label>
        <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $about->pendidikan) }}">
        @error('pendidikan') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="gpa" class="form-label">GPA</label>
        <input type="text" class="form-control" id="gpa" name="gpa" value="{{ old('gpa', $about->gpa) }}">
        @error('gpa') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi', $about->lokasi) }}">
        @error('lokasi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
```

`resources/views/back/about/delete.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Delete About')

@section('content')
<h1>Delete About</h1>
<p>Are you sure you want to delete this about?</p>
<p><strong>{{ $about->judul }}</strong></p>
<form action="{{ url('/about/' . $about->id . '/delete') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="{{ url('/about') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
```

### Skill Views

`resources/views/back/skill/index.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Manage Skills')

@section('content')
<h1>Skill Management</h1>
<a href="{{ url('/skill/create') }}" class="btn btn-primary mb-3">Add Skill</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($skills as $skill)
        <tr>
            <td>{{ $skill->id }}</td>
            <td>{{ $skill->nama }}</td>
            <td>
                <a href="{{ url('/skill/' . $skill->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/skill/' . $skill->id . '/delete') }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
```

`resources/views/back/skill/create.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Add Skill')

@section('content')
<h1>Add Skill</h1>
<form action="{{ url('/skill/create') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Skill</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
```

`resources/views/back/skill/edit.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Edit Skill')

@section('content')
<h1>Edit Skill</h1>
<form action="{{ url('/skill/' . $skill->id) }}" method="PUT">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Skill</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $skill->nama) }}" required>
        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
```

`resources/views/back/skill/delete.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Delete Skill')

@section('content')
<h1>Delete Skill</h1>
<p>Are you sure you want to delete this skill?</p>
<p><strong>{{ $skill->nama }}</strong></p>
<form action="{{ url('/skill/' . $skill->id) }}" method="DELETE">
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="{{ url('/skill') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
```

### Project Views

`resources/views/back/project/index.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Manage Projects')

@section('content')
<h1>Project Management</h1>
<a href="{{ url('/project/create') }}" class="btn btn-primary mb-3">Add Project</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Foto</th>
            <th>Link</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->judul_proyek }}</td>
            <td><img src="{{ asset('img/project/' . $project->foto) }}" width="50" alt=""></td>
            <td>{{ $project->link ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ url('/project/' . $project->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/project/' . $project->id . '/delete') }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
```

`resources/views/back/project/create.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Add Project')

@section('content')
<h1>Add Project</h1>
<form action="{{ url('/project') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="judul_proyek" class="form-label">Judul Proyek</label>
        <input type="text" class="form-control" id="judul_proyek" name="judul_proyek" value="{{ old('judul_proyek') }}" required>
        @error('judul_proyek') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi_proyek" class="form-label">Deskripsi Proyek</label>
        <textarea class="form-control" id="deskripsi_proyek" name="deskripsi_proyek" rows="3" required>{{ old('deskripsi_proyek') }}</textarea>
        @error('deskripsi_proyek') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        @error('foto') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="link" class="form-label">Link</label>
        <input type="url" class="form-control" id="link" name="link" value="{{ old('link') }}">
        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
```

`resources/views/back/project/edit.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<h1>Edit Project</h1>
<form action="{{ url('/project/' . $project->id) }}" method="PUT" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="judul_proyek" class="form-label">Judul Proyek</label>
        <input type="text" class="form-control" id="judul_proyek" name="judul_proyek" value="{{ old('judul_proyek', $project->judul_proyek) }}" required>
        @error('judul_proyek') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi_proyek" class="form-label">Deskripsi Proyek</label>
        <textarea class="form-control" id="deskripsi_proyek" name="deskripsi_proyek" rows="3" required>{{ old('deskripsi_proyek', $project->deskripsi_proyek) }}</textarea>
        @error('deskripsi_proyek') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        @if($project->foto)
        <img src="{{ asset('img/project/' . $project->foto) }}" width="100" alt="">
        @endif
        @error('foto') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="link" class="form-label">Link</label>
        <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $project->link) }}">
        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
```

`resources/views/back/project/delete.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Delete Project')

@section('content')
<h1>Delete Project</h1>
<p>Are you sure you want to delete this project?</p>
<p><strong>{{ $project->judul_proyek }}</strong></p>
<form action="{{ url('/project/' . $project->id) }}" method="DELETE">
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="{{ url('/project') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
```

### User Views

`resources/views/back/user/index.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<h1>Account Settings</h1>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $data->name }}</h5>
        <p class="card-text">{{ $data->email }}</p>
        <a href="{{ url('/pengaturan-akun/' . $data->id . '/edit') }}" class="btn btn-warning">Edit Account</a>
    </div>
</div>
@endsection
```

`resources/views/back/user/edit.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Edit Account')

@section('content')
<h1>Edit Account</h1>
<form action="{{ url('/pengaturan-akun/' . $user->id . '/update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password">
        @error('new_password') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
        @error('new_password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
```

### Auth Views

`resources/views/back/login.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
```

`resources/views/back/dashboard.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>
<p>Welcome to your portfolio admin panel.</p>
@endsection
```

Buat views serupa untuk About, Skill, Project, User, dan Auth.

## Langkah 8: File Upload Handling

Di controller, tambahkan method `prosesFoto` untuk sanitasi nama file dan hapus file lama.

Pastikan folder `public/img/hero`, `public/img/project` ada.

## Langkah 9: Error Handling

Di setiap controller, tambahkan try-catch di store, update, destroy dengan logging dan sweetalert.

## Langkah 10: Benchmark (Opsional)

Untuk mengukur performa, gunakan `Benchmark::value()` di HomepageController.

## Langkah 11: Testing dan Deploy

1. Jalankan `php artisan serve`
2. Tes semua bagian

Project ini sekarang siap digunakan sebagai portofolio pribadi!
