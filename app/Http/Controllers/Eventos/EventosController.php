<?php

namespace App\Http\Controllers\Eventos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Eventos\AdicionarEvento;
use App\Http\Requests\Eventos\EditarEvento;
use App\Models\Eventos\EventosModel;
use Illuminate\Http\Request;
use App\Models\User;

class EventosController extends Controller
{

    protected $eventos;
    protected $users;
    public function __construct(EventosModel $eventos, User $users)
    {
        $this->middleware('auth')->except('verEvento');
        $this->eventos = $eventos;
        $this->users = $users;
    }

    public function listar(Request $request)
    {
        $data = $this->eventos->getAll();
        return view('eventos.listar', compact('data'));
    }

    public function verEvento(Request $request, $id)
    {
        $users = $this->users->get();
        $data = $this->eventos->getById($id);
        return view('eventos.ver', compact('data', 'users'));
    }

    public function verCriar(Request $request)
    {
        $users = $this->users->get();
        $status = $this->statusEventos();
        return view('eventos.criar', compact('users', 'status'));
    }

    public function criar(AdicionarEvento $request)
    {
        $data = $request->validated();
        $create = $this->eventos->create($data);
        if (empty($create)) return redirect()->back();
        return redirect()->route('eventos.listar');
    }

    public function deletarEvento(Request $request, $id)
    {
        $delete = $this->eventos->where('id', $id)->update(['status' => 0]);
        return redirect()->route('eventos.listar');
    }

    public function verEditar(Request $request, $id)
    {
        $users = $this->users->get();
        $data = $this->eventos->getForEdit($id);
        $status = $this->statusEventos();
        return view('eventos.editar', compact('data', 'users', 'status'));
    }

    private function statusEventos()
    {
        return ['EM DISCUSSÃO', 'PLANEJAMENTO', 'PLANEJADO', 'FINALIZADO', 'CANCELADO'];
    }

    public function editar(EditarEvento $request, $id)
    {
        $data = $request->validated();
        $update = $this->eventos->where('id', $id)->update($data);
        if ($update) {
            return redirect()->route('eventos.listar');
        }
        return redirect()->back();
    }
}
