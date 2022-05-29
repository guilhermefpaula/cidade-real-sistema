<?php

namespace App\Models\Eventos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'regras',
        'finalizado_at'
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
            ->orderBy('status_evento', 'desc')
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

    public function getForEdit($id)
    {
        return $this
            ->where('cidade_real_eventos.id', $id)
            ->first();
    }

    public function buscaDados()
    {
        $querie =  $this
            ->whereYear('finalizado_at', '=', Carbon::now()->format('Y'))
            ->whereMonth('finalizado_at', '=', Carbon::today()->format('m'))
            ->where('status_evento', 'FINALIZADO')
            ->where('status', 1)
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE_FORMAT(finalizado_at, "%d/%m") as date'),
                DB::raw('COUNT( * ) as "count"')
            ])
            ->pluck('count', 'date');

        return $querie;
    }
    public function getCountEventosDoMes()
    {
        $querie =  $this
            ->whereYear('finalizado_at', '=', Carbon::now()->format('Y'))
            ->whereMonth('finalizado_at', '=', Carbon::today()->format('m'))
            ->where('status_evento', 'FINALIZADO')
            ->where('status', 1)
            ->count();

        return $querie;
    }
}
