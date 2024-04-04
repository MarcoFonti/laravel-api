<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        /* CREO TIPOLOGIE DEL PROGETTO */
        $labels = ['Ecommerce', 'Consegna', 'Social', 'Messaggistica', 'Analisi'];

        /* CICLO SUI LABELS */
        foreach($labels as $label){
            
            /* CREO NUOVA ISTANZA */
            $type = new Type();

            /* ASSEGNO LA PROPIETA' DELL'OGGETTO ALLA VARIBILE */
            $type->label = $label;

            /* SLUG */
            $type->slug = Str::slug($label);
            
            /* ASSEGNO LA PROPIETA' DELL'OGGETTO A UN METODO FAKER */
            $type->color = $faker->hexColor();
                        
            /* SALVATAGGIO */
            $type->save();
        }
    }
}