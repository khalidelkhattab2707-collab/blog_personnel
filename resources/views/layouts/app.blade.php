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
            background: #f8fafc;
            color: #1e293b;
        }

        /* NAVBAR */
        nav {
            background: #0f172a;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }

        nav .logo span { color: #f97316; }

        nav .links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        nav .links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        nav .links a:hover { color: #f97316; }

        nav .links form button {
            background: none;
            border: 1px solid #f97316;
            color: #f97316;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        nav .links form button:hover {
            background: #f97316;
            color: white;
        }

        /* CONTENU */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 20px;
            color: #94a3b8;
            font-size: 0.8rem;
            margin-top: 60px;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav>
        <a href="{{ route('home') }}" class="logo">Blog<span>Personnel</span></a>

        <div class="links">
            <a href="{{ route('articles.index') }}">📝 Articles</a>

            @auth
                <a href="{{ route('dashboard') }}">⚙️ Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Déconnexion</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}">🔐 Connexion</a>
            @endguest
        </div>
    </nav>

    {{-- CONTENU DE LA PAGE --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer>
        BlogPersonnel © 2026 · Fait avec Laravel
    </footer>

</body>
</html>