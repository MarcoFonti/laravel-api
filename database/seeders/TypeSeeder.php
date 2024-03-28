<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
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
        $labels = ['E-commerce', 'Consegna di Cibo', 'Social Media', 'Messaggistica Chat', 'Analisi dei Dati'];

        /* CICLO SUI LABELS */
        foreach($labels as $label){
            
            /* CREO NUOVA ISTANZA */
            $type = new Type();

            /* ASSEGNO LA PROPIETA' DELL'OGGETTO ALLA VARIBILE */
            $type->label = $label;
            
            /* ASSEGNO LA PROPIETA' DELL'OGGETTO A UN METODO FAKER */
            $type->color = $faker->hexColor();
                        
            /* SALVATAGGIO */
            $type->save();
        }
    }
}