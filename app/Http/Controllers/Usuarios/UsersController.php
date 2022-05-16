<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdicionaUser;
use App\Http\Requests\User\EditarUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function listar(Request $request)
    {
        $data = $this->user->orderBy('name', 'asc')->get();
        return view('usuarios.listar', compact('data'));
    }

    public function verUsuario(Request $request, $id)
    {
        $user = $this->user->where('id', $id)->first();
        return view('usuarios.editar', compact('user'));
    }

    public function verCriar(Request $request)
    {

        return view('usuarios.criar');
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
        ]);
        if ($create) return redirect()->route('usuarios.listar');
        return redirect()->back();
    }
}
