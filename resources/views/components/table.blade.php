<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="main-card">
            <table id="table" class="table table-dark table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        @foreach(explode(',', $headers) as $header)
                        <th>
                            {{ $header }}
                        </th>
                        @endforeach
                        <th>
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        @foreach(explode(',',$campos) as $campo)
                        <td>
                            {{ $item->$campo }}
                        </td>
                        @endforeach
                        <td>
                            @if(!empty($routeEditar))
                            <a class="btn btn-success" href="{{ route($routeEditar, $item->id)}}">
                                EDITAR
                            </a>
                            @endif
                            @if(!empty($routeVer))
                            <a class="btn btn-primary" href="{{ route($routeVer, $item->id)}}">
                                VER
                            </a>
                            @endif
                            @if(!empty($routeRemover))
                            <a class="btn btn-danger" href="{{ route($routeRemover, $item->id)}}">
                                REMOVER
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>