<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Petition;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        # Con esto llamamos al seeder del usuario
        $this->call(RoleSeeder::class); 
        $this->call(UserSeeder::class); 
        

        # Con esto llamamos a los factories. Entre paréntesis se coloca el número de filas
        Category::factory(8)->create(); 
        Article::factory(20)->create(); 
        Comment::factory(20)->create(); 
        Petition::factory(50)->create(); 
        Author::factory(10)->create(); 

        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');

    }
}
