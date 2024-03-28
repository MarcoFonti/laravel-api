<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* CREO ARRAY CON GLI ID DEL MODEL PROJECT */
        $projects_ids = Project::pluck('id')->toArray();

        
        /* CREO TECNOLOGIE DEL PROGETTO */
        $tecno_information = [
            ['label' => 'HTML', 'color' => 'info'],
            ['label' => 'CSS', 'color' => 'primary'],
            ['label' => 'Bootstrap', 'color' => 'secondary'],
            ['label' => 'JS', 'color' => 'warning'],
            ['label' => 'Vue', 'color' => 'success'],
            ['label' => 'Laravel', 'color' => 'danger'],
        ];

        /* CICLO SULLE TECNOLOGIE */
        foreach($tecno_information as $tecno_info){
            
            /* CREO NUOVA ISTANZA */
            $technology = new Technology();

            /* ASSEGNO LA PROPIETA' LABEL DELL'ARRAY ASSOCIATIVO ALLA VARIBILE */
            $technology->label = $tecno_info['label'];
            
            /* ASSEGNO LA PROPIETA' COLOR DELL'ARRAY ASSOCIATIVO ALLA VARIABILE */
            $technology->color = $tecno_info['color'];   
                     
            /* SALVATAGGIO */
            $technology->save();

            /* CREO UN ARRAY CHE SELEZIONE CASUALEMENTE GLI ID DEL MODEL PROJECT */
            $technology_projects = array_filter($projects_ids, fn () => rand(0,1));
            
            /* ATTACCO I RECORD DLLE TECNOLOGIE AI PROGETTI */
            $technology->projects()->attach($technology_projects);
        }
    }
}