@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<i class="fa fa-vcard-o"></i> Diagnostico
                </div>

                <div class="panel-body">

					<ul class="nav nav-tabs nav-justified">
                	<?php $num = 0; ?>
					@foreach($categorias as $categoria)
						<li><a data-toggle="tab" href="#tab_{{$num++}}">{{$categoria->nombre}}</a></li>
					@endforeach
						<li><a data-toggle="tab" href="#tab_{{$num++}}"><i class="fa fa-check-circle"></i> Consultar</a></li>
					</ul>

					<div class="tab-content">
	                	<?php $num = 0; ?>
						@foreach($categorias as $categoria)
						<div id="tab_{{$num++}}" @if($num == 0) class="tab-pane fade in active" @else class="tab-pane fade" @endif>
						 	<h3>{{$categoria->nombre}}</h3>
		                	<?php $aux = 0; ?>
		                	@foreach($categoria->sintomas as $sintoma)
								@if(($aux == 0) || ($aux%5 == 0))
									<div class="col-md-4">
								   		<div class="list-group">
								@endif
									<a href="#" class="list-group-item" id="{{$sintoma->id}}">
										<h4 class="list-group-item-heading">{{$sintoma->nombre}}</h4>
										<p class="list-group-item-text">{{$sintoma->descripcion}}</p>
									</a>
									<?php $aux++; ?>
								@if($aux%5 == 0)
								   		</div>
								  	</div>
								@endif
							@endforeach
							@if($aux%5 > 0)
							  		</div>
							  	</div>
							@endif
						</div>
						@endforeach
						<div id="tab_{{$num++}}" class="tab-pane fade">
							<br/>
							<div class="col-md-12" align="center">
	                            <div class="col-md-4 col-md-offset-4">
	                                <button type="submit" class="btn btn-block btn-lg btn-success" onclick="consultaBayes()">
	                                    <strong>Consulta<br/>de Especialidad</strong>
	                                </button>
	                            </div>
	                        </div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    {!! Html::script('js/jquery.min.js') !!}

<script type="text/javascript">
	var sintoma_array = [];
	$(document).ready(function() {
		$('.list-group-item').click(function(e) {
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				if(sintoma_array.indexOf(parseInt($(this).first().attr('id'))) >= 0){
					sintoma_array.splice(sintoma_array.indexOf(parseInt($(this).first().attr('id'))), 1);
				}
			}else{
	    		$(this).addClass('active');
	    		sintoma_array.push(parseInt($(this).first().attr('id')));
	    	}
	    });
        $('.nav-tabs a[href="#tab_0"]').tab('show');
    });
	function consultaBayes(){
		if(sintoma_array.length>0){
			$.ajax({
	            type: "POST",
	            headers: {'X-CSRF-Token':"{{ csrf_token() }}"},
	            url: 'bayes/consulta',
	            data: {sintomas: sintoma_array},
	            success: function( msg ) {
	            	alert("Solicite ficha para " + msg['nombre']);
	            }
	        });
		}else{
			alert("Debe seleccionar al menos un sintoma");
			$('.nav-tabs a[href="#tab_0"]').tab('show');
		}
	}
</script>