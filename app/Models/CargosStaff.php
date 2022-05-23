<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargosStaff extends Model
{
    protected $table = 'users_cargos_staff';

    protected $fillable = ['cargo', 'sigla'];
}
