@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="container">
    <a class="btn btn-primary text-right" href="{{ route('usuarios.ver.criar')}}">
        NOVO USUARIO
    </a>
    <x-table headers="Nome,Ultimo Acesso" :data="$data" campos="name,ultimo_login" routeEditar="usuarios.ver.editar"></x-table>
</div>
@endsection