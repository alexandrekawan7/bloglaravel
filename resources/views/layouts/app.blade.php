<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Mini-Blog')</title>

    {{-- Fonte próxima do visual do Medium --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@400;700&display=swap"
      rel="stylesheet"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-neutral-900 antialiased">
    {{-- Navbar --}}
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-neutral-200">
        <nav class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('posts.index') }}" class="font-semibold tracking-tight text-xl">
                Blog PWEB
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center rounded-full border border-neutral-300 px-4 py-2 text-sm font-medium hover:bg-neutral-50 transition">
                   Novo post
                </a>
            </div>
        </nav>
    </header>

    {{-- Corpo --}}
    <main class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-neutral-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-8 text-sm text-neutral-500 flex items-center justify-between">
            <span>BLOG PWEB © {{ now()->year }}</span>
            <span class="hidden sm:inline">Prof. Zé Olinda</span>
        </div>
    </footer>
</body>
</html>