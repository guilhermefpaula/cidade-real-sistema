@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('VER EVENTO') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="titulo" class="col-md-4 col-form-label text-md-end">{{ __('Titulo') }}</label>
                        <div class="col-md-6">
                            <input disabled id="titulo" type="text" class="form-control" name="titulo" value="{{ $data->titulo }}" autocomplete="titulo" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="titulo" class="col-md-4 col-form-label text-md-end">{{ __('Próximo Evento') }}</label>
                        <div class="col-md-6">
                            <input disabled type="text" class="form-control" value="{{ $data->proximo_evento }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="min_players" class="col-md-4 col-form-label text-md-end">{{ __('Status do evento') }}</label>
                        <div class="col-md-6">
                            <input disabled type="text" class="form-control" value="{{ $data->status_evento }}" autocomplete="min_players">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="min_players" class="col-md-4 col-form-label text-md-end">{{ __('Minimo de Jogadores') }}</label>
                        <div class="col-md-6">
                            <input disabled id="min_players" type="number" class="form-control" name="min_players" value="{{ $data->min_players }}" autocomplete="min_players">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="min_staffs" class="col-md-4 col-form-label text-md-end">{{ __('Minimo de Staffs') }}</label>
                        <div class="col-md-6">
                            <input disabled id="min_staffs" type="number" class="form-control" name="min_staffs" value="{{$data->min_staffs }}" autocomplete="min_staffs">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="frequencia" class="col-md-4 col-form-label text-md-end">{{ __('Frequencia') }}</label>
                        <div class="col-md-6">
                            <input disabled id="frequencia" type="text" class="form-control" name="frequencia" value="{{$data->frequencia }}" autocomplete="frequencia">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="backstory" class="col-md-4 col-form-label text-md-end">{{ __('Back Story') }}</label>
                        <div class="col-md-6">
                            <textarea disabled id="backstory" rows="7" type="text" class="form-control" name="backstory" value="" autocomplete="backstory">{{$data->backstory }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="realizacao" class="col-md-4 col-form-label text-md-end">{{ __('Como Realizar') }}</label>
                        <div class="col-md-6">
                            <textarea disabled id="realizacao" type="text" rows="7" class="form-control" name="realizacao" value="" autocomplete="realizacao">{{ $data->realizacao }}</textarea>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="regras" class="col-md-4 col-form-label text-md-end">{{ __('Regras') }}</label>
                        <div class="col-md-6">
                            <textarea id="regras" type="text" disabled class="form-control" name="regras" rows="7" autocomplete="regras">{{ $data->regras }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="observacoes" class="col-md-4 col-form-label text-md-end">{{ __('Observações') }}</label>
                        <div class="col-md-6">
                            <textarea disabled id="observacoes" type="text" rows="7" class="form-control " name="observacoes" value="" autocomplete="observacoes">{{$data->observacoes }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="responsavel" class="col-md-4 col-form-label text-md-end">{{ __('Responsável') }}</label>
                        <div class="col-md-6">
                            <select id="responsavel" type="text" class="form-control" name="responsavel" value="" disabled>
                                @foreach($users as $user)
                                <option value="{{ $user->id}}" {{ $data->responsavel == $user->id ? 'selected' : ''}}> {{ $user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection