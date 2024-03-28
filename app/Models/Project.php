<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class Project extends Model
{
    use HasFactory;
    /* ELIMINAZIONE SOFT */
    use SoftDeletes;

    /* ASSEGNO VALORI DI MASSA */
    protected $fillable = ['title', 'slug', 'content', 'image', 'is_published', 'type_id'];

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

    /* FUNZIONE IMMAGINI */
    public function assetUrl(){
        return asset('storage/' . $this->image);
    }

    /* RELAZIONE CON IL MODELLO TYPE */
    public function type() {
        /* UN SOLO TYPE */
        return $this->belongsTo(Type::class);
    }

    /* RELAZIONE CON IL MODELLO TECHNOLOGY */
    public function technologies() {
        /* MOLTE TECNOLOGIE */
        return $this->belongsToMany(Technology::class);
    }
}