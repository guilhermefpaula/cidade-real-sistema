@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="container">
    <a class="btn btn-primary text-right" href="{{ route('eventos.ver.criar')}}">
        NOVO EVENTO
    </a>
    <x-table headers="Título,Próximo Evento,Responsável,Status" :data="$data" campos="titulo,proximo_evento,name,status_evento" routeEditar="eventos.ver.editar" routeVer="eventos.ver" routeRemover="eventos.remover"></x-table>
</div>
@endsection