<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Dashboard — liste tous les articles
    public function index()
    {
        $articles = Article::with('category')
                           ->latest()
                           ->get();

        $total     = $articles->count();
        $published = $articles->where('status', 'published')->count();
        $drafts    = $articles->where('status', 'draft')->count();

        return view('admin.dashboard', compact('articles', 'total', 'published', 'drafts'));
    }

    // Formulaire création
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    // Sauvegarder nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
        ]);

        Article::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'status'      => $request->status,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Article créé avec succès !');
    }

    // Formulaire modification
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    // Mettre à jour article
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
        ]);

        $article->update([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Article modifié avec succès !');
    }

    // Supprimer article
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Article supprimé !');
    }
}