<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gilang Risky Mahardika | Fullstack Developer</title>
    <link rel="shortcut icon" href="{{ asset('icon/icon.png') }}" type="image/x-icon" />
    <link href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('front/style.css') }}" />
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                @yield('logo')
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                style="border-color: #00b7ff">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="mailto:gilangriskymahardhika@gmail.com" class="contact-card-link">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <h4 class="contact-title">Email</h4>
                            {{-- <p class="contact-info"></p> --}}
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="https://www.linkedin.com/in/gilang-risky-mahardika" target="_blank"
                        class="contact-card-link">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-linkedin"></i>
                            </div>
                            <h4 class="contact-title">LinkedIn</h4>
                            {{-- <p class="contact-info"></p> --}}
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="https://github.com/IgnaGilangFaith-Main" target="_blank" class="contact-card-link">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-github"></i>
                            </div>
                            <h4 class="contact-title">GitHub</h4>
                            {{-- <p class="contact-info"></p> --}}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="social-links text-center mb-3">
                <a href="https://www.linkedin.com/in/gilang-risky-mahardika"><i class="bi bi-github"></i></a>
                <a href="https://github.com/IgnaGilangFaith-Main"><i class="bi bi-linkedin"></i></a>
            </div>
            <p class="footer-text">
                &copy; 2025 Gilang Risky Mahardika. All Rights Reserved.
            </p>
        </div>
    </footer>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
