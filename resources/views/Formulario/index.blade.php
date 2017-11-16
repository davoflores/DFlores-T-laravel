@extends('layout')

@section('content')
	<div id="alerta">
		
	</div>
 
	<form method="post" action="{{ url('Formulario/procesar') }}" id="fechasForm">
		{{ csrf_field() }}
		<!-- cantidad de filas -->
		<input type="hidden" name="cantidad" id="cantidad">


		<button onclick="agregar()" type="button" id="agregarbtn">Agregar fecha</button>
		<button onclick="quitar()" type="button" id="quitarbtn">Quitar fecha</button>


		<div id="formularioTionvel"></div>

		<button type="submit" id="procesar">Procesar</button>

	</form>

	<script src="{{ asset('/formulario.js') }}"></script>
@endsection