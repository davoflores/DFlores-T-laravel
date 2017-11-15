@extends('layout')

@section('content')
	@if($alerta)
		{{$alerta}}
	@else
		@for ($i = 0; $i < count($retorno)/3; $i++)
			<span>Fecha {{$i+1}}:{{$retorno[3*$i]}}</span>
			<span>N&uacute;mero {{$i+1}}:{{$retorno[(3*$i)+1]}}</span>
			<span>Fecha calculada {{$i+1}}:{{$retorno[(3*$i)+2]}}</span>
			</br> 
		@endfor
	@endif
@endsection