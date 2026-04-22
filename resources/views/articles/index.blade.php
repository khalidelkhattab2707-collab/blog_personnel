@extends('layouts.app')

@section('content')

    <h1 style="margin-bottom: 10px;">📝 Articles</h1>
    <p style="color: #64748b; margin-bottom: 30px;">Tous les articles publiés</p>

    {{-- FILTRE CATÉGORIES --}}
    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 30px;">

        <a href="{{ route('articles.index') }}"
           style="padding: 6px 16px; border-radius: 20px; text-decoration: none; font-size: 0.85rem;
                  background: {{ !request('category') ? '#f97316' : '#e2e8f0' }};
                  color: {{ !request('category') ? 'white' : '#475569' }};">
            Tous
        </a>

        @foreach($categories as $cat)
            <a href="{{ route('articles.index', ['category' => $cat->id]) }}"
               style="padding: 6px 16px; border-radius: 20px; text-decoration: none; font-size: 0.85rem;
                      background: {{ request('category') == $cat->id ? '#f97316' : '#e2e8f0' }};
                      color: {{ request('category') == $cat->id ? 'white' : '#475569' }};">
                {{ $cat->name }}
            </a>
        @endforeach

    </div>

    {{-- LISTE DES ARTICLES --}}
    @if($articles->isEmpty())
        <p style="color: #94a3b8;">Aucun article trouvé.</p>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">

            @foreach($articles as $article)
                <div style="background: white; border-radius: 12px; padding: 24px;
                            box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">

                    {{-- Catégorie --}}
                    <span style="background: #fff7ed; color: #f97316; padding: 4px 10px;
                                 border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                        {{ $article->category->name }}
                    </span>

                    {{-- Titre --}}
                    <h2 style="margin: 12px 0 8px; font-size: 1.1rem;">
                        <a href="{{ route('articles.show', $article) }}"
                           style="text-decoration: none; color: #0f172a;">
                            {{ $article->title }}
                        </a>
                    </h2>

                    {{-- Extrait --}}
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6;">
                        {{ Str::limit($article->content, 100) }}
                    </p>

                    {{-- Date + Lire plus --}}
                    <div style="display: flex; justify-content: space-between;
                                align-items: center; margin-top: 16px;">
                        <span style="color: #94a3b8; font-size: 0.8rem;">
                            {{ $article->created_at->format('d/m/Y') }}
                        </span>
                        <a href="{{ route('articles.show', $article) }}"
                           style="color: #f97316; font-size: 0.85rem; text-decoration: none;">
                            Lire →
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
    @endif

@endsection