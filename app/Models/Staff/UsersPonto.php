<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UsersPonto extends Model
{

    protected $table = 'users_pontos';

    protected $fillable = [
        'user_id',
        'hora_entrada',
        'hora_pausa',
        'hora_volta',
        'hora_saida',
    ];

    public function findPontoAtual($id)
    {
        return $this->where('user_id', $id)->whereNull('hora_saida')->first();
    }

    public function baterPonto($id)
    {

        $data = [];

        $ponto = $this->where('user_id', $id)->whereNull('hora_saida')->first();
        if (empty($ponto)) {
            $data['user_id'] = $id;
            $data['hora_entrada'] = now();
            return $this->create($data);
        } elseif (empty($ponto->hora_pausa)) {
            $data['hora_pausa'] = now();
            return $this->where('user_id', $id)->update($data);
        } elseif (empty($ponto->hora_volta)) {
            $data['hora_volta'] = now();
            return $this->where('user_id', $id)->update($data);
        } elseif (empty($ponto->hora_saida)) {
            $data['hora_saida'] = now();
            $update =  $this->where('user_id', $id)->update($data);
            if ($update) {
                $this->enviaWebHook($id, $ponto);
                return $update;
            }
        }
    }

    private function enviaWebHook($id, $ponto)
    {

        $user = DB::table('users')->where('id', $id)->first();

        if ($user->cargo_staff == 1) {
            $cargo = 'HELPER';
            $url = env('DISCORD_PONTO_SUP_URL');
        } elseif ($user->cargo_staff == 2) {
            $cargo = 'SUPORTE';
            $url = env('DISCORD_PONTO_SUP_URL');
        } elseif ($user->cargo_staff == 3) {
            $cargo = 'MODERADOR';
            $url = env('DISCORD_PONTO_MOD_URL');
        } else {
            return;
        }
        $message = "Nome: " . $user->name .
            "\nCargo: " . $cargo . "\nEntrada: " . date('H:i', strtotime($ponto->hora_entrada)) . "\nPausa: " . date('H:i', strtotime($ponto->hora_pausa)) . "\nRetorno: " . date('H:i', strtotime($ponto->hora_volta)) . "\nSaída: " . now()->format('H:i');

        Http::post($url, [
            "content" => $message
        ]);
    }
}
