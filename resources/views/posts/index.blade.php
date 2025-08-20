@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    {{-- Título + CTA --}}
    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight font-[Merriweather]">
            Últimos posts
        </h1>
        <p class="mt-2 text-neutral-600">
            Ideias, tutoriais e reflexões — em um feed limpo ao estilo Medium.
        </p>
    </div>

    {{-- Flash message --}}
    @if ($message = Session::get('success'))
        <div class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ $message }}
        </div>
    @endif

    @if (count($posts) > 0)
        <div class="space-y-8">
            @foreach ($posts as $post)
                <article class="group">
                    <a href="{{ route('posts.show', $post) }}" class="block">
                        <div class="grid grid-cols-12 gap-4">
                            {{-- Imagem de capa --}}
                            <div class="col-span-12 sm:col-span-4">
                                <div class="aspect-[16/10] overflow-hidden rounded-lg border border-neutral-200">
                                    <img
                                      src="{{ asset('images/' . $post->image) }}"
                                      alt="Capa do post"
                                      class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                    />
                                </div>
                            </div>

                            {{-- Conteúdo --}}
                            <div class="col-span-12 sm:col-span-8">
                                <h2 class="text-xl sm:text-2xl font-semibold leading-tight group-hover:underline decoration-2">
                                    {{ $post->title }}
                                </h2>

                                {{-- Metadados (ajuste conforme seu modelo: autor, data, tempo de leitura) --}}
                                <div class="mt-1 text-sm text-neutral-500">
                                    <span>por {{ $post->author->name ?? 'Autor(a) desconhecido(a)' }}</span>
                                    <span class="mx-2">•</span>
                                    <time datetime="{{ $post->created_at->toDateString() }}">
                                        {{ $post->created_at->format('d M Y') }}
                                    </time>
                                </div>

                                {{-- Descrição / resumo --}}
                                <p class="mt-3 text-neutral-700 leading-relaxed clamp-3">
                                    {{ $post->description }}
                                </p>

                                {{-- Ações / tags (opcional) --}}
                                <div class="mt-4 flex items-center gap-3">
                                    <span class="inline-flex items-center rounded-full bg-neutral-100 px-3 py-1 text-xs text-neutral-700">
                                        #blog
                                    </span>
                                    <span class="inline-flex items-center rounded-full bg-neutral-100 px-3 py-1 text-xs text-neutral-700">
                                        #laravel
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Separador ao estilo Medium --}}
                    <hr class="mt-6 border-neutral-200" />
                </article>
            @endforeach
        </div>
    @else
        <div class="text-neutral-500">Nenhum post encontrado.</div>
    @endif
@endsection
