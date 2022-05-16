<?php

namespace App\Models\Eventos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EventosModel extends Model
{
    protected $table = 'cidade_real_eventos';

    protected $fillable = [
        'titulo',
        'min_players',
        'proximo_evento',
        'tamanho',
        'min_staffs',
        'frequencia',
        'backstory',
        'realizacao',
        'observacoes',
        'status',
        'responsavel',
        'status_evento',
        'regras'
    ];


    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function getAll()
    {
        return $this
            ->select('cidade_real_eventos.id', 'titulo', 'proximo_evento', 'users.name', 'status_evento')
            ->where('status', 1)
            ->orderBy('titulo', 'asc')
            ->join('users', 'users.id', '=', 'responsavel')
            ->get();
    }

    public function getById($id)
    {
        return $this
            ->select('cidade_real_eventos.*', 'users.name as responsavel')
            ->where('cidade_real_eventos.id', $id)
            ->join('users', 'users.id', '=', 'responsavel')
            ->first();
    }

    public function getForEdit($id) {
        return $this
        ->where('cidade_real_eventos.id', $id)
        ->first(); 
    }
}
