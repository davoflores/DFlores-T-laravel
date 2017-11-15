//arreglo de objetos que contienen un número y una fecha
var elementos = [];

$(document).ready(function() {

	var numero_1 = $('<input>');
	numero_1.attr("type", "number");
	numero_1.attr("name", "numero_1");
	numero_1.attr("required", "required");
	numero_1.attr("min", "0");
	numero_1.attr("placeholder", "Ingese un n\u00FAmero");

	var fecha_1 = $('<input>');
	fecha_1.attr("type", "date");
	fecha_1.attr("name", "fecha_1");
	fecha_1.attr("required", "required");
	fecha_1.attr("placeholder", "Ingrese una fecha");

	var div_1 = $('<div>');

	div_1.append(fecha_1);
	div_1.append(numero_1);

	//cada vez que se muestran los elementos deben aparecer por lo menos los primeros
	$('#formularioTionvel').append(div_1);

	elementos[0] =  {fecha:fecha_1, numero:numero_1};

	$('#fechasForm').on('submit', function(e){
        e.preventDefault();
        if(validar()) this.submit();
    });
});

//agrega una fila dentro del formulario de id formularioTionvel
function agregar(){
	var formulario = $('#formularioTionvel');

	//agregamos una nueva fila
	var numero_i = $('<input>');
	numero_i.attr("type", "number");
	numero_i.attr("name", "numero_"+(elementos.length+1));
	numero_i.attr("required", "required");
	numero_i.attr("min", "0");
	numero_i.attr("placeholder", "Ingese un n\u00FAmero");

	var fecha_i = $('<input>');
	fecha_i.attr("type", "date");
	fecha_i.attr("name", "fecha_"+(elementos.length+1));
	fecha_i.attr("required", "required");
	fecha_i.attr("placeholder", "Ingrese una fecha");

	var div_i = $('<div>');
	div_i.append(fecha_i);
	div_i.append(numero_i);

	formulario.append(div_i);
	
	elementos[elementos.length] =  {fecha:fecha_i, numero:numero_i};
}


function quitar(){
	if(elementos.length>1){
		$('#formularioTionvel div').last().remove();

		elementos.pop();
	}
}

function validar(){
	//cantidad de elementos
	var largo = elementos.length;
	
	//si hay un elemento
	if(largo == 1){
		$('#cantidad').val(1);
		return true;
	}
	else{
		var fechaAnterior = elementos[0]['fecha'].val();

		for(var i=1; i<elementos.length; i++){
			var fechai = elementos[i]['fecha'].val();
			if(fechai<=fechaAnterior){
				$('#alerta').html('cada fecha debe ser mayor a la anterior');
				return false;	
			} 
			fechaAnterior = fechai;
		}

	}

	$('#cantidad').val(elementos.length);
	return true;
}