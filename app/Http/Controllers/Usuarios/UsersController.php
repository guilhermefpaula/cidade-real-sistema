<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdicionaUser;
use App\Http\Requests\User\EditarUser;
use App\Models\CargosStaff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    protected $user;
    protected $cargosStaff;

    public function __construct(User $user, CargosStaff $cargosStaff)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->cargosStaff = $cargosStaff;
    }

    public function listar(Request $request)
    {
        $data = $this->user->getAll();
        $headers = ["Nome", "Ultimo Acesso", "Cargo"];
        $campos = ["name", "ultimo_login", "cargo"];
        $routeEditar = "usuarios.ver.editar";
        return view('usuarios.listar', compact('data', 'headers', 'campos', 'routeEditar'));
    }

    public function verUsuario(Request $request, $id)
    {
        $user = $this->user->where('id', $id)->first();
        $cargos = $this->cargosStaff->get();
        return view('usuarios.editar', compact('user', 'cargos'));
    }

    public function verCriar(Request $request)
    {
        $cargos = $this->cargosStaff->get();
        return view('usuarios.criar', compact('cargos'));
    }

    public function editar(EditarUser $request, $id)
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
}
