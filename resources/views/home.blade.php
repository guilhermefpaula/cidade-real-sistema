@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inicio') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!empty(auth()->user()))
                    <a href="{{ route('usuarios.listar')}}"> Ver Usuarios</a><br>
                    <a href="{{ route('eventos.listar')}}"> Ver Eventos</a>
                    @else
                    <a href="{{ route('login')}}"> Entrar</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection