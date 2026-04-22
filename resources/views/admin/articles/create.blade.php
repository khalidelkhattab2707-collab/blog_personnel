@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.dashboard') }}"
       style="color: #f97316; text-decoration: none; font-size: 0.9rem;">
        ← Retour au dashboard
    </a>

    <div style="max-width: 750px; margin: 30px auto; background: white;
                border-radius: 12px; padding: 40px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

        <h1 style="margin-bottom: 30px;">+ Nouvel article</h1>

        {{-- Erreurs --}}
        @if($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 12px 20px;
                        border-radius: 8px; margin-bottom: 20px;">
                @foreach($errors->all() as $error)
                    <p>❌ {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.articles.store') }}" method="POST">
            @csrf

            {{-- Titre --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Titre</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0;
                              border-radius: 8px; font-size: 0.95rem;"
                       placeholder="Titre de l'article">
            </div>

            {{-- Catégorie --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Catégorie</label>
                <select name="category_id"
                        style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0;
                               border-radius: 8px; font-size: 0.95rem;">
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Statut --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Statut</label>
                <select name="status"
                        style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0;
                               border-radius: 8px; font-size: 0.95rem;">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                        📝 Brouillon
                    </option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                        ✅ Publié
                    </option>
                </select>
            </div>

            {{-- Contenu --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Contenu</label>
                <textarea name="content" rows="10"
                          style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0;
                                 border-radius: 8px; font-size: 0.95rem; resize: vertical;"
                          placeholder="Écris ton article ici...">{{ old('content') }}</textarea>
            </div>

            {{-- Bouton --}}
            <button type="submit"
                    style="background: #f97316; color: white; padding: 12px 30px;
                           border: none; border-radius: 8px; cursor: pointer;
                           font-size: 1rem; font-weight: 600;">
                Sauvegarder
            </button>

        </form>
    </div>

@endsection