@extends('layouts.front')

@section('logo')
    @if ($heroes->count() > 0)
        @foreach ($heroes as $hero)
            <img src="{{ asset('img/hero/' . $hero->foto) }}" alt="Logo" height="40" />
        @endforeach
    @else
        <img src="img/logo/logo.png" alt="Logo" height="40" />
    @endif
@endsection

@section('content')
    @if ($heroes->count() > 0)
        @foreach ($heroes as $hero)
            <section class="hero-section" id="home">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 hero-content">
                            <p class="text-uppercase mb-2" style="color: #00b7ff; letter-spacing: 3px; font-size: 0.9rem">
                                Welcome to my portfolio
                            </p>
                            <h1 class="hero-title">{{ $hero->nama }}</h1>
                            <h2 class="hero-subtitle">{{ $hero->moto }}</h2>
                            <p class="hero-description">
                                {{ $hero->deskripsi }}
                            </p>
                            <div class="mt-4">
                                <a href="#projects" class="btn btn-primary-custom me-3">View Projects</a>
                                <a href="#contact" class="btn btn-outline-custom">Contact Me</a>
                            </div>
                        </div>
                        <div class="col-lg-5 text-center mt-5 mt-lg-0">
                            <div class="profile-image-wrapper">
                                <div class="profile-glow">
                                    <div class="profile-image">
                                        <img src="{{ asset('img/hero/' . $hero->foto) }}" alt="Logo"
                                            class="profile-logo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @else
        <section class="hero-section" id="home">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 hero-content">
                        <p class="text-uppercase mb-2" style="color: #00b7ff; letter-spacing: 3px; font-size: 0.9rem">
                            Welcome to my portfolio
                        </p>
                        <h1 class="hero-title">Your Name</h1>
                        <h2 class="hero-subtitle">Your Motto</h2>
                        <p class="hero-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam ut ea deleniti exercitationem
                            cupiditate ratione sit, culpa nostrum doloribus quibusdam rem laboriosam ipsa cumque id modi
                            fugit corrupti ducimus perspiciatis iusto eaque amet odit minus earum! Ab minima aut sapiente
                            culpa, quia, nemo illum ullam, molestias tenetur eligendi delectus voluptatibus impedit fuga
                            nulla deserunt facilis perferendis iste nihil ut cum nobis ipsam voluptate enim. Consectetur,
                            dignissimos placeat deleniti libero itaque tenetur labore nostrum neque, amet doloribus ratione!
                            Officia quae ipsa, accusantium neque veritatis iusto ab ex hic, maiores magnam quasi quaerat
                            harum vero culpa veniam modi molestias mollitia, dignissimos placeat!
                        </p>
                        <div class="mt-4">
                            <a href="#projects" class="btn btn-primary-custom me-3">View Projects</a>
                            <a href="#contact" class="btn btn-outline-custom">Contact Me</a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center mt-5 mt-lg-0">
                        <div class="profile-image-wrapper">
                            <div class="profile-glow">
                                <div class="profile-image">
                                    <img src="#" alt="Your Logo" class="profile-logo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="about-section" id="about">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="about-card">
                        <div class="row">
                            @if ($abouts->count() > 0)
                                @foreach ($abouts as $about)
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h3 class="mb-3" style="color: #00b7ff">{{ $about->judul }}</h3>
                                        <p style="color: #b0b0b0; line-height: 1.8">
                                            {{ $about->deskripsi }}
                                        </p>
                                        <div class="mt-4">
                                            <p class="mb-2">
                                                <i class="bi bi-mortarboard-fill me-2" style="color: #00b7ff"></i>
                                                {{ $about->pendidikan }}
                                            </p>
                                            <p class="mb-2">
                                                <i class="bi bi-award-fill me-2" style="color: #00b7ff"></i>
                                                {{ $about->gpa }}
                                            </p>
                                            <p class="mb-0">
                                                <i class="bi bi-geo-alt-fill me-2" style="color: #00b7ff"></i>
                                                {{ $about->lokasi }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h3 class="mb-3" style="color: #00b7ff">Your Title</h3>
                                    <p style="color: #b0b0b0; line-height: 1.8">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores fugit placeat
                                        sit? Pariatur numquam necessitatibus molestias provident, voluptate repellat maiores
                                        quo soluta sed sunt facere error praesentium officia velit laudantium ad doloribus
                                        voluptates distinctio porro? Facilis quas delectus quis magni eius cumque rerum
                                        laudantium incidunt, veniam mollitia! Incidunt error a maiores non? Quis maiores at
                                        accusantium quod? Minus asperiores laudantium beatae ad modi nisi et. Nam officiis
                                        nesciunt, fuga libero ad quasi quam quas fugiat illum deserunt cum cumque possimus
                                        alias iste nemo aspernatur nulla officia eius. Soluta laboriosam modi architecto
                                        accusamus illo aliquid dignissimos praesentium laudantium, autem, impedit voluptas!
                                    </p>
                                    <div class="mt-4">
                                        <p class="mb-2">
                                            <i class="bi bi-mortarboard-fill me-2" style="color: #00b7ff"></i>
                                            Your Education
                                        </p>
                                        <p class="mb-2">
                                            <i class="bi bi-award-fill me-2" style="color: #00b7ff"></i>
                                            Your GPA
                                        </p>
                                        <p class="mb-0">
                                            <i class="bi bi-geo-alt-fill me-2" style="color: #00b7ff"></i>
                                            Your Location
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <h3 class="mb-3" style="color: #00b7ff">My Skills</h3>
                                <div class="skills-wrapper">
                                    @if ($skills->count() > 0)
                                        @foreach ($skills as $skill)
                                            <span class="skill-badge">{{ $skill->nama }}</span>
                                        @endforeach
                                    @else
                                        <span class="skill-badge">Your Skill</span>
                                        <span class="skill-badge">Your Skill</span>
                                        <span class="skill-badge">Your Skill</span>
                                        <span class="skill-badge">Your Skill</span>
                                        <span class="skill-badge">Your Skill</span>
                                        <span class="skill-badge">Your Skill</span>
                                        <span class="skill-badge">Your Skill</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $projects->count() }}</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $abouts->first()->gpa ?? 'N/A' }}</div>
                        <div class="stat-label">GPA Achievement</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Dedication</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="projects-section" id="projects">
        <div class="container">
            <h2 class="section-title">My Projects</h2>
            <div class="row">

                @if ($projects->count() > 0)
                    @foreach ($projects as $project)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a @if ($project->link != null) href="{{ $project->link }}" target="_blank" @endif
                                class="project-card-link">
                                <div class="glow-card">
                                    <div class="glow-card-content">
                                        <img src="{{ asset('img/project/' . $project->foto) }}" alt="Your Project" />
                                        <div class="project-overlay">
                                            <h4 class="project-title">{{ $project->judul_proyek }}</h4>
                                            <p class="project-desc">
                                                {{ Str::limit($project->deskripsi_proyek, 100) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="#" target="_blank" class="project-card-link">
                            <div class="glow-card">
                                <div class="glow-card-content">
                                    <img src="#" alt="Your Project" />
                                    <div class="project-overlay">
                                        <h4 class="project-title">Your Project Title</h4>
                                        <p class="project-desc">
                                            Your Project Description
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="#" target="_blank" class="project-card-link">
                            <div class="glow-card">
                                <div class="glow-card-content">
                                    <img src="#" alt="Your Project" />
                                    <div class="project-overlay">
                                        <h4 class="project-title">Your Project Title</h4>
                                        <p class="project-desc">
                                            Your Project Description
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="#" target="_blank" class="project-card-link">
                            <div class="glow-card">
                                <div class="glow-card-content">
                                    <img src="#" alt="Your Project" />
                                    <div class="project-overlay">
                                        <h4 class="project-title">Your Project Title</h4>
                                        <p class="project-desc">
                                            Your Project Description
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
