<?php

namespace App\Models\Staff;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_jogo',
        'cargo_jogo',
        'ultimo_login',
        'cargo_staff',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAll()
    {
        return $this->select('users.id', 'name', 'ultimo_login', 'cargo')->leftJoin('users_cargos_staff', 'users_cargos_staff.id', '=', 'users.cargo_staff')->orderBy('name', 'asc')->get();
    }

    public function getAtivosAgora()
    {
        return $this->join('users_pontos', 'users_pontos.user_id', 'users.id')->whereNull('hora_saida')->count();
    }
}
