@extends('layouts.app')

@section('content')

    <h1 style="margin-bottom: 5px;">⚙️ Dashboard Admin</h1>
    <p style="color: #64748b; margin-bottom: 30px;">
        Bienvenue, {{ auth()->user()->name }} 👋
    </p>

    {{-- Message succès --}}
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px 20px;
                    border-radius: 8px; margin-bottom: 20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- STATS --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr);
                gap: 20px; margin-bottom: 40px;">

        <div style="background: white; border-radius: 12px; padding: 24px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.08); border-left: 4px solid #f97316;">
            <p style="color: #94a3b8; font-size: 0.85rem;">Total articles</p>
            <h2 style="font-size: 2rem; color: #0f172a;">{{ $total }}</h2>
        </div>

        <div style="background: white; border-radius: 12px; padding: 24px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.08); border-left: 4px solid #22c55e;">
            <p style="color: #94a3b8; font-size: 0.85rem;">Publiés</p>
            <h2 style="font-size: 2rem; color: #0f172a;">{{ $published }}</h2>
        </div>

        <div style="background: white; border-radius: 12px; padding: 24px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.08); border-left: 4px solid #94a3b8;">
            <p style="color: #94a3b8; font-size: 0.85rem;">Brouillons</p>
            <h2 style="font-size: 2rem; color: #0f172a;">{{ $drafts }}</h2>
        </div>

    </div>

    {{-- BOUTON CRÉER --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.articles.create') }}"
           style="background: #f97316; color: white; padding: 10px 20px;
                  border-radius: 8px; text-decoration: none; font-size: 0.9rem;">
            + Nouvel article
        </a>
    </div>

    {{-- TABLE --}}
    <div style="background: white; border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; color: #64748b;">Titre</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; color: #64748b;">Catégorie</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; color: #64748b;">Statut</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; color: #64748b;">Date</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; color: #64748b;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr style="border-bottom: 1px solid #f1f5f9;">

                        {{-- Titre --}}
                        <td style="padding: 14px 20px; font-weight: 600;">
                            {{ $article->title }}
                        </td>

                        {{-- Catégorie --}}
                        <td style="padding: 14px 20px; color: #64748b;">
                            {{ $article->category->name }}
                        </td>

                        {{-- Statut --}}
                        <td style="padding: 14px 20px;">
                            @if($article->status === 'published')
                                <span style="background: #dcfce7; color: #166534; padding: 4px 10px;
                                             border-radius: 20px; font-size: 0.75rem;">
                                    ✅ Publié
                                </span>
                            @else
                                <span style="background: #f1f5f9; color: #64748b; padding: 4px 10px;
                                             border-radius: 20px; font-size: 0.75rem;">
                                    📝 Brouillon
                                </span>
                            @endif
                        </td>

                        {{-- Date --}}
                        <td style="padding: 14px 20px; color: #94a3b8; font-size: 0.85rem;">
                            {{ $article->created_at->format('d/m/Y') }}
                        </td>

                        {{-- Actions --}}
                        <td style="padding: 14px 20px;">
                            <div style="display: flex; gap: 10px;">

                                {{-- Modifier --}}
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                   style="background: #f97316; color: white; padding: 6px 12px;
                                          border-radius: 6px; text-decoration: none; font-size: 0.8rem;">
                                    ✏️ Modifier
                                </a>

                                {{-- Supprimer --}}
                                <form action="{{ route('admin.articles.destroy', $article) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer cet article ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="background: #ef4444; color: white; padding: 6px 12px;
                                                   border-radius: 6px; border: none; cursor: pointer; font-size: 0.8rem;">
                                        🗑️ Supprimer
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                            Aucun article. Créez votre premier article !
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection