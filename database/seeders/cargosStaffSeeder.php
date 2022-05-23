<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cargosStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'cargo' => 'Helper',
                'sigla' => 'HELPER'
            ],
            [
                'cargo' => 'Suporte',
                'sigla' => 'SUP'
            ],
            [
                'cargo' => 'Moderador',
                'sigla' => 'MOD'
            ],
            [
                'cargo' => 'Administrador',
                'sigla' => 'ADMIN'
            ],
            [
                'cargo' => 'STAFF',
                'sigla' => 'STAFF'
            ],
            [
                'cargo' => 'Admnistrador Geral',
                'sigla' => 'ADM GERAL'
            ],
            [
                'cargo' => 'Responsavel Geral',
                'sigla' => 'RESP GERAL'
            ],
            [
                'cargo' => 'Responsavel STAFF',
                'sigla' => 'RESP STAFF'
            ],
            [
                'cargo' => 'Responsavel Moderadores',
                'sigla' => 'RESP MOD'
            ],
            [
                'cargo' => 'Responsavel Suporte',
                'sigla' => 'RESP SUP'
            ],
            [
                'cargo' => 'Responsavel Eventos',
                'sigla' => 'RESP EVENTOS'
            ],
        ];
        DB::table('users_cargos_staff')->insert($data);
    }
}
