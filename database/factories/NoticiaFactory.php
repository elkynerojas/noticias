<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = fake()->sentence(6);
        
        return [
            'titulo' => $titulo,
            'texto' => fake()->paragraphs(5, true),
            'imagen' => fake()->optional()->imageUrl(800, 600, 'news', true),
            'slug' => Str::slug($titulo) . '-' . fake()->unique()->numberBetween(1000, 9999),
        ];
    }
}
