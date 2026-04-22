<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer les 4 catégories
        $categories = ['PHP', 'Laravel', 'JavaScript', 'DevOps'];
        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        // 2. Créer le blogueur
        $user = User::create([
            'name'     => 'Mon Blog',
            'email'    => 'admin@blog.com',
            'password' => Hash::make('password123'),
        ]);

        // 3. Créer 6 articles (mix brouillons/publiés)
        Article::create([
            'title'       => 'Introduction à Laravel',
            'content'     => 'Laravel est un framework PHP...',
            'status'      => 'published',
            'category_id' => 2,
            'user_id'     => $user->id,
        ]);

        Article::create([
            'title'       => 'Les bases de PHP',
            'content'     => 'PHP est un langage serveur...',
            'status'      => 'published',
            'category_id' => 1,
            'user_id'     => $user->id,
        ]);

        Article::create([
            'title'       => 'Eloquent ORM expliqué',
            'content'     => 'Eloquent permet de...',
            'status'      => 'draft',
            'category_id' => 2,
            'user_id'     => $user->id,
        ]);

        // ... 3 autres articles
    }
}