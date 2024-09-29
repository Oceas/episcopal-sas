<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyEpiscopal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

<div class="min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />

            @if (Route::has('login'))
                <nav class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-800 hover:text-gray-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">Log in</a>

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">Register</a>--}}
{{--                        @endif--}}

                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
        <div class="text-center">
            <blockquote class="text-2xl font-semibold italic text-gray-600">
                "Trust in the Lord with all your heart and lean not on your own understanding."
                <br/>
                <span class="text-sm font-light text-gray-500">- Proverbs 3:5</span>
            </blockquote>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-6">
        <div class="container mx-auto text-center text-gray-600 text-sm">
            © {{ date('Y') }} MyEpiscopal
        </div>
    </footer>

</div>

</body>
</html>
