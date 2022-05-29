@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Bater Ponto') }}</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('usuario.bater.ponto')}}">
                        @csrf
                        @if(empty($ponto->hora_entrada))
                        <button type="submit" class="btn btn-primary">ENTRADA</button>
                        @elseif(empty($ponto->hora_pausa))
                        <button type="submit" class="btn btn-success">PAUSA</button>
                        @elseif(empty($ponto->hora_volta))
                        <button type="submit" class="btn btn-success">VOLTA</button>
                        @elseif(empty($ponto->hora_saida))
                        <button type="submit" class="btn btn-danger">Finalizar Expediente</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection