<?php

namespace App\Http\Controllers\Eventos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Eventos\AdicionarEvento;
use App\Http\Requests\Eventos\EditarEvento;
use App\Models\Eventos\EventosModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;

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
        $headers = ['Título', 'Data/Hora', 'Responsável', 'Status'];
        $campos = ['titulo', 'proximo_evento', 'name', 'status_evento'];
        $routeEditar = "eventos.ver.editar";
        $routeVer = "eventos.ver";
        $routeRemover = "eventos.remover";
        return view('eventos.listar', compact('data', 'headers', 'campos', 'routeEditar', 'routeVer', 'routeRemover'));
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
        $frequencia = $this->frequenciasEvento();
        return view('eventos.criar', compact('users', 'status', 'frequencia'));
    }

    public function criar(AdicionarEvento $request)
    {
        $data = $request->validated();
        $create = $this->eventos->create($data);
        if ($data['status_evento'] == 'FINALIZADO') $data['finalizado_at'] = now();
        if (empty($create)) return redirect()->back();
        return redirect()->route('eventos.listar');
    }


    public function deletarEvento(Request $request, $id)
    {
        $this->eventos->where('id', $id)->update(['status' => 0]);
        return redirect()->route('eventos.listar');
    }

    public function verEditar(Request $request, $id)
    {
        $users = $this->users->get();
        $data = $this->eventos->getForEdit($id);
        $status = $this->statusEventos();
        $frequencia = $this->frequenciasEvento();
        return view('eventos.editar', compact('data', 'users', 'status', 'frequencia'));
    }

    public function editar(EditarEvento $request, $id)
    {
        $data = $request->validated();
        if ($data['status_evento'] == 'FINALIZADO') {
            $evento = $this->eventos->where('id', $id)->first()->finalizado_at;
            if (empty($evento)) {
                $data['finalizado_at'] = now();
                $message = "EVENTO: " . $data['titulo'] . "
                DIA: " . $data['proximo_evento'] . " 
                LINK DO EVENTO: " . route('eventos.ver', $id);
                Http::post(env('DISCORD_EVENTOS_URL'), [
                    "content" => $message
                ]);
            }
        }
        $update = $this->eventos->where('id', $id)->update($data);
        if ($update) {
            return redirect()->route('eventos.listar');
        }
        return redirect()->back();
    }


    private function frequenciasEvento()
    {
        return ['EVENTO ÚNICO', 'TODO DIA', 'TODA SEMANA', 'TODO MÊS'];
    }

    private function statusEventos()
    {
        return ['EM DISCUSSÃO', 'PLANEJAMENTO', 'PLANEJADO', 'FINALIZADO', 'CANCELADO'];
    }

    public function buscaDados()
    {
        return $this->eventos->buscaDados();
    }
}
