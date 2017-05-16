@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text"></i> Historial medico de {{ $paciente->nombre_completo() }} ({{ $paciente->edad() }} años)
                </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Doctor</th>
                                    <th>Especialidad</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Sintoma(s)</th>
                                    <th>Enfermedad(es)</th>
                                    <th>Diagnostico</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 1; ?>
                                @foreach($paciente->diagnosticos as $diagnostico)
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$diagnostico->user->name}}</td>
                                        <td>{{$diagnostico->user->especialidad->nombre}}</td>
                                        <td>{{$diagnostico->fecha_creacion()}}</td>
                                        <td>{{$diagnostico->hora_creacion()}}</td>
                                        <td>
                                            @foreach($diagnostico->sintomas as $sintoma_lista)
                                            - {{ $sintoma_lista->nombre }}<br/>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($diagnostico->enfermedades as $enfermedad_lista)
                                                - {{ $enfermedad_lista->nombre }}<br/>
                                            @endforeach
                                        </td>
                                        <td>
                                            <p>{{ $diagnostico->recomendacion }}</p>
                                        </td>
                                        <td>
                                            <a href="{{route('diagnostico.show',$diagnostico->id)}}" class="btn btn-success"><i class="fa fa-file-text"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
