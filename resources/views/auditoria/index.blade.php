@extends('plantilla.plantilla')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <h3>Registro de Actividades</h3>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                    <th>ID Usuario</th>
                                    <th>Acción</th>
                                    <th>Detalles</th>
                                    <th>Fecha de Creación</th>
                                </thead>
                                <tbody>
                                    @if ($activityLogs->count())
                                        @foreach ($activityLogs as $log)
                                            <tr>
                                                <td>{{ $log->user_id }}</td>
                                                <td>{{ $log->action }}</td>
                                                <td>{{ $log->details }}</td>
                                                <td>{{ $log->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No hay registro de actividades !!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $activityLogs->links() }}
                </div>
            </div>
        </section>
    @endsection
