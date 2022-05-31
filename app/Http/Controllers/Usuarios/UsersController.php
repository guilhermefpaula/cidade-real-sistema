<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdicionaUser;
use App\Http\Requests\User\EditarUser;
use App\Models\Staff\CargosStaff;
use App\Models\Staff\User;
use App\Models\Staff\UsersPonto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    protected $user;
    protected $cargosStaff;
    protected $usersPonto;

    public function __construct(
        User $user,
        CargosStaff $cargosStaff,
        UsersPonto $usersPonto
    ) {
        $this->middleware('auth');
        $this->user = $user;
        $this->cargosStaff = $cargosStaff;
        $this->usersPonto = $usersPonto;
    }

    protected function listar(Request $request)
    {
        $data = $this->user->getAll();
        $headers = ["Nome", "Ultimo Acesso", "Cargo"];
        $campos = ["name", "ultimo_login", "cargo"];
        $routeEditar = "usuarios.ver.editar";
        return view('usuarios.listar', compact('data', 'headers', 'campos', 'routeEditar'));
    }

    protected function verUsuario(Request $request, $id)
    {
        $user = $this->user->where('id', $id)->first();
        $cargos = $this->cargosStaff->orderBy('cargo', 'asc')->get();
        return view('usuarios.editar', compact('user', 'cargos'));
    }

    protected function verCriar(Request $request)
    {
        $cargos = $this->cargosStaff->orderBy('cargo', 'asc')->get();

        return view('usuarios.criar', compact('cargos'));
    }

    protected function editar(EditarUser $request, $id)
    {
        $data = $request->validated();
        $update = $this->user->where('id', $id)->update($data);
        if (!empty($update)) return redirect()->route('usuarios.listar');
        return redirect()->back();
    }

    protected function criar(AdicionaUser $request)
    {
        $data = $request->validated();
        $create =  $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cargo_staff' => $data['cargo_staff']
        ]);
        if ($create) return redirect()->route('usuarios.listar');
        return redirect()->back();
    }

    protected function verPontoStaff(Request $request)
    {
        $ponto = $this->usersPonto->findPontoAtual(auth()->user()->id);
        return view('usuarios.bater_ponto', compact('ponto'));
    }

    protected function baterPonto(Request $request)
    {
        $this->usersPonto->baterPonto(auth()->user()->id);
        return redirect()->route('usuarios.ver.bater.ponto');
    }

    protected function verPontos(Request $request)
    {
        $data = $this->usersPonto->getAll();
        $headers = ["Nome", "Hora da Entrada", "Hora da Pausa", "Hora Do Retorno", "Hora da Saída"];
        $campos = ["name", "hora_entrada", "hora_pausa", "hora_volta", "hora_saida"];
        $routeRemover = "usuarios.pontos.remover";
        return view('gestao.pontos', compact('data', 'headers', 'campos', 'routeRemover'));
    }

    protected function removePonto(Request $request, $id)
    {
        $this->usersPonto->where('id',$id)->delete();
        return redirect()->route('usuarios.pontos.listar');
    }
}
