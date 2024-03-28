<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* ALL'AVVIO CREO LA CARTELLA PER L'IMMAGINI */
        Storage::makeDirectory('project_images');
        
        /* TITOLO */
        $title = fake()->text(20);

        /* SLUG */
        $slug = Str::slug($title);

        /* CREO FILE */
        $file = fake()->image(null ,350, 350);

        /* SALVO FILE */
        $url = Storage::putFileAs('project_images', $file, "$slug.png");

        /* CREO UN ARRAY CON DENTRO GLI ID DELLE MIEI TIPOLOGIE */
        $type_ids = Type::pluck('id')->toArray();

        /* AGGIUNGO ALL'ARRAY LA TIPOLOGIA NULLA */
        $type_ids[] = null;

        return [
            'title' => $title,
            'slug' => $slug,
            'type_id' => Arr::random($type_ids),
            'content' => fake()->paragraphs(15, true),
            'image' => $url,
            'is_published' => fake()->boolean()
        ];
    }
}