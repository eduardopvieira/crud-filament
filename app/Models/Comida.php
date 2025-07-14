<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comida extends Model
{
    use HasFactory;
    
    protected $fillable = ['nome', 'preco', 'quantidade', 'modo-de-preparo', 'tipo_id', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}
