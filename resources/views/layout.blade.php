<!DOCTYPE html>
<html>
<head>
    <title>Mnasati - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1.*/css/pico.min.css">
</head>
<body>
    <nav style="padding: 1em; display: flex; justify-content: flex-end;">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
        <a href="{{ route('login') }}">Login</a>
        @endauth
    </nav>

    <main class="container">
        <h1>@yield('title')</h1>
        @yield('content')
    </main>
</body>
</html>
