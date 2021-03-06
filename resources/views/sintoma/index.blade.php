@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<i class="fa fa-eye"></i> Sintomas
                	<div class="pull-right">
						<a href="{{route('sintoma.create')}}" class="btn btn-primary btn-xs pull-right"> <i class="fa fa-plus-circle"></i> Nuevo</a>
                	</div>
                </div>

                <div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Categoria</th>
								<th>Casos</th>
								<th>Imagen</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php $num = 1; ?>
							@foreach($sintomas as $sintoma)
								<tr>
									<td>{{$num++}}</td>
									<td>{{$sintoma->nombre}}</td>
									<td>{{$sintoma->descripcion}}</td>
									<td>
									@if ($sintoma->categoria)
										{{$sintoma->categoria->nombre}}
									@else
										-
                                	@endif
									</td>
									<td>{{$sintoma->diagnosticosCount()}}</td>
									<td>
									@if ($sintoma->imagen)
										<img src="{{ $sintoma->imagen }}" width="50px"/>
                                	@endif
									</td>
									<td>
										<a href="{{route('sintoma.edit',$sintoma->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									</td>
									<td>
										<form class="" action="{{route('sintoma.destroy',$sintoma->id)}}" method="post">
											<input type="hidden" name="_method" value="delete">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar este registro?');"><i class="fa fa-trash"></i></button>
										</form>
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
@endsection