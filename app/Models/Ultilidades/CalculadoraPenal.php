<?php

namespace App\Models\Ultilidades;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculadoraPenal extends Model
{
    protected $table = 'calculadora_penal';

    protected $fillable = ['user_id', 'motivo', 'tipo', 'qnt_meses'];
}
