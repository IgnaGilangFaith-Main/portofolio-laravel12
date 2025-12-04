<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Portfolio') }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .error-header {
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 800;
            line-height: 1;
            text-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .error-body {
            padding: 2rem;
            text-align: center;
        }

        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        /* Error type colors */
        .error-400 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .error-401 {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .error-403 {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        }

        .error-404 {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        }

        .error-405 {
            background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%);
        }

        .error-419 {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        }

        .error-429 {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .error-500 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-503 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .error-400 .error-code,
        .error-404 .error-code,
        .error-405 .error-code,
        .error-419 .error-code,
        .error-429 .error-code {
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-card mx-auto">
            <div class="error-header @yield('error-class')">
                <div class="error-code">@yield('code')</div>
            </div>
            <div class="error-body">
                <div class="error-icon text-secondary">
                    @yield('icon')
                </div>
                <h4 class="fw-bold mb-3">@yield('title')</h4>
                <p class="text-muted mb-4">@yield('message')</p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="bi bi-house me-1"></i> Halaman Utama
                    </a>
                    <button onclick="history.back()" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
