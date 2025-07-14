<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    // public function comidas(): HasMany
    // {
    //     return $this->hasMany(Comida::class);
    // }
}
