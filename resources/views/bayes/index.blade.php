@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<i class="fa fa-eye"></i> Sintomas
                </div>

                <div class="panel-body">
                	<?php $num = 0; ?>
                	@foreach($sintomas as $sintoma)
						@if(($num == 0) || ($num%5 == 0))
							<div class="col-md-4">
						   		<div class="list-group">
						@endif
							<a href="#" class="list-group-item" id="{{$sintoma->id}}">
								<h4 class="list-group-item-heading">{{$sintoma->nombre}}</h4>
								<p class="list-group-item-text">{{$sintoma->descripcion}}</p>
							</a>
							<?php $num = $num + 1; ?>
						@if($num%5 == 0)
						   		</div>
						  	</div>
						@endif
					@endforeach
					@if($num%5 > 0)
					   		</div>
					  	</div>
					@endif
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="col-md-6" align="left">
                                <button type="submit" class="btn btn-block btn-lg btn-success" onclick="consultaBayes()">
                                    Consultar
                                </button>
                            </div>
                            <div class="col-md-6" align="right">
                                <a class="btn btn-default btn-lg btn-block" href="{{url()->previous()}}">
                                    Cancelar
                                </a>
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
	$(function(){
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
	    	console.log(sintoma_array);
	    });
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
		}
	}
</script>