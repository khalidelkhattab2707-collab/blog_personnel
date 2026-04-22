@extends('layouts.app')

@section('content')

    {{-- Retour --}}
    <a href="{{ route('articles.index') }}"
       style="color: #f97316; text-decoration: none; font-size: 0.9rem;">
        ← Retour aux articles
    </a>

    <div style="max-width: 750px; margin: 30px auto; background: white;
                border-radius: 12px; padding: 40px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

        {{-- Catégorie --}}
        <span style="background: #fff7ed; color: #f97316; padding: 4px 10px;
                     border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
            {{ $article->category->name }}
        </span>

        {{-- Titre --}}
        <h1 style="margin: 16px 0 8px; font-size: 1.8rem; color: #0f172a;">
            {{ $article->title }}
        </h1>

        {{-- Date --}}
        <p style="color: #94a3b8; font-size: 0.85rem; margin-bottom: 30px;">
            Publié le {{ $article->created_at->format('d/m/Y') }}
        </p>

        {{-- Séparateur --}}
        <hr style="border: none; border-top: 1px solid #e2e8f0; margin-bottom: 30px;">

        {{-- Contenu --}}
        <div style="line-height: 1.8; color: #334155; font-size: 1rem;">
            {!! nl2br(e($article->content)) !!}
        </div>

    </div>

@endsection