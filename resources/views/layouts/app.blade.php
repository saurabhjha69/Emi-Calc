<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EMI Calculator Admin')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background: #343a40;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        nav {
            background: #e9ecef;
            padding: 10px 20px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #999;
            font-size: 14px;
        }

        </style>
        @yield('styles')
</head>
<body>

    <header>
        <h1>EMI Calculator Admin</h1>
    </header>

    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('tenures.index') }}">Tenures</a>
        <a href="{{ route('emi_rules.index') }}">Emi Rules</a>

    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} EMI Calculator System
    </footer>

</body>
</html>
