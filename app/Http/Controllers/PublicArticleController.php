<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    // Liste des articles publiés + filtre catégorie
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
                        ->with('category');

        // Filtre par catégorie si demandé
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $articles   = $query->latest()->get();
        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories'));
    }

    // Détail d'un article
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}