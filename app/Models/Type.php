<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Type extends Model
{
    use HasFactory;

    /* ASSEGNO VALORI DI MASSA */
    protected $fillable = ['label', 'color'];

    /* RELAZIONE CON IL MEDELLO PROJECT */
    public function projects() {
        /* MOLTI PROGETTI */
        return $this->hasMany(Project::class);
    }

    /* FUNZIONE DI DATA CREAZIONE */
    public function getCreatedAt()
    {
        return Carbon::create($this->created_at)->format('d-m-Y H:i:s');
    }
    
    /* FUNZIONE DI DATA MODIFICA */
    public function getUpdatedAt()
    {
        return Carbon::create($this->update_at)->format('d-m-Y H:i:s',);
    }
}