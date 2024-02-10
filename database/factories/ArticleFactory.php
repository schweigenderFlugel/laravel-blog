<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->unique()->realText(55); 
        return [
            'title' => $title,
            'slug' => Str::slug($title), # Hay que importarlo como Illuminate\Support\Str;
            'introduction' => $this->faker->realText(255),
            'image' => 'articles/'.$this->faker->image('public/storage/articles', 640, 480, null, false),
            // public/storage/articles/foto.png (true)
            // foto.png (false)
            // articles/foto.png
            'body' => $this->faker->text(2000),
            'status' => $this->faker->boolean(), 
            'user_id' => User::all()->random()->id, 
            'category_id' => Category::all()->random()->id,
        ];
    }
}
