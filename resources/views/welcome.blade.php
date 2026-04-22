<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPersonnel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #0f172a;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* LOGO */
        .logo {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 10px;
        }

        .logo span {
            color: #f97316;
        }

        /* TAGLINE */
        .tagline {
            font-size: 1rem;
            color: #94a3b8;
            margin-bottom: 50px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* LOADING BAR */
        .loading-bar-container {
            width: 300px;
            height: 4px;
            background: #1e293b;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .loading-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #f97316, #fb923c);
            border-radius: 10px;
            animation: load 2.5s ease forwards;
        }

        @keyframes load {
            0%   { width: 0%; }
            100% { width: 100%; }
        }

        /* STATUS TEXT */
        .status {
            font-size: 0.8rem;
            color: #475569;
            letter-spacing: 2px;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }

        /* NAV LINKS */
        .nav-links {
            position: absolute;
            top: 20px;
            right: 30px;
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #f97316;
        }

        /* VERSION */
        .version {
            position: absolute;
            bottom: 20px;
            font-size: 0.75rem;
            color: #334155;
        }
    </style>
</head>
<body>

    {{-- Navigation --}}
    <div class="nav-links">
        <a href="{{ route('articles.index') }}">📝 Articles</a>
        @auth
            <a href="{{ route('admin.dashboard') }}">⚙️ Dashboard</a>
        @else
            <a href="{{ route('login') }}">🔐 Connexion</a>
        @endauth
    </div>

    {{-- Logo --}}
    <div class="logo">
        Blog<span>Personnel</span>
    </div>

    {{-- Tagline --}}
    <p class="tagline">Partage de connaissances & réflexions</p>

    {{-- Loading Bar --}}
    <div class="loading-bar-container">
        <div class="loading-bar" id="bar"></div>
    </div>

    {{-- Status --}}
    <p class="status" id="status">Chargement...</p>

    {{-- Version --}}
    <p class="version">Laravel v13 · BlogPersonnel © 2026</p>

    <script>
        // Après 2.5s → redirect vers articles
        setTimeout(() => {
            document.getElementById('status').textContent = 'Prêt !';
            setTimeout(() => {
                window.location.href = "{{ route('articles.index') }}";
            }, 500);
        }, 2500);
    </script>

</body>
</html>