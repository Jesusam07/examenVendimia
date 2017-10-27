$(document).on("ready", main);

var base_url = window.location.origin + "/examen";

function main(){

	configurarChosen();

	$("#idCliente").change(function() {
		if($("#idCliente").val() != ""){
			getRFC( $("#idCliente").val() );
		}
		else {
			$("#rfc").val("");
		}
	});

	$("#idArticulo").change(function() {
		if($("#idArticulo").val() != ""){
			getModelo( $("#idArticulo").val() );
		}
		else {
			$("#modelo").val("");
		}
	});

	$(document).on('click', '#eliminarArt', function(event) {
		event.preventDefault();
		$(this).closest('tr').remove();
	});
}

function configurarChosen(){
	var config = {
	  '.chosen-select'           : {},
	  '.chosen-select-deselect'  : { allow_single_deselect: true },
	  '.chosen-select-no-single' : { disable_search_threshold: 10 },
	  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
	  '.chosen-select-rtl'       : { rtl: true },
	  '.chosen-select-width'     : { width: '100%' }
	}
	for (var selector in config) {
	  $(selector).chosen(config[selector]);
	}
}



function getRFC(id_cliente){
	$.ajax({
		url: base_url + "/funciones.php?"+id_cliente,
		type:"POST",
		data:{idCliente:id_cliente},
		success:function(respuesta){
			console.log(respuesta);
			$("#rfc").val(respuesta);
		}
	});
}

function getModelo(id_articulo){
	$.ajax({
		url: base_url + "/funciones1.php?"+id_articulo,
		type:"POST",
		data:{idArticulo:id_articulo},
		success:function(respuesta){
			console.log(respuesta);
			$("#modelo").val(respuesta);
		}
	});
}

// Añadir Articulos a la venta
function agregarArticulo(){
	//Validar campos vacios
	if($("#idArticulo").val() == "") {
		alert("Por favor, selecciona el articulo");
		return;
	}
	if($("#idCliente").val() == "") {
		alert("Ingrese un ID");
		return;
	}
	if($("#cantidad").val() == "") {		
		alert("Por favor, ingresa la cantidad");
		return;
	}
	else {
		if($("#cantidad").val() <= 0) {
			alert("La cantidad debe ser mayor a 0");
			return;
		}
		else {
			if ($("#cantidad").val() % 1 != 0) {
			alert("La cantidad debe ser un nùmero entero");
				return;
	        }
		}
	}


	//Crear las columnas
	var table = document.getElementById("tabla-detalles");
    var row = table.insertRow(1);
    var descripcion = row.insertCell(0);
    var modelo = row.insertCell(1);
    var cantidad = row.insertCell(2);
    var precio = row.insertCell(3);
    var importe = row.insertCell(4);
    var opcion = row.insertCell(5);

    //Agregar los detalles
    descripcion.innerHTML = $("#idArticulo option:selected").text();     
    modelo.innerHTML = "DB";
    cantidad.innerHTML = $("#cantidad").val();
    precio.innerHTML = "98";
    importe.innerHTML = "98";
    opcion.innerHTML = '<center><button type="button" id="eliminarArt" class="btn btn-danger btn-xs" title="Eliminar Detalle"><span class="glyphicon glyphicon-trash"></span></button>';
return;

	// Extraer los datos del articulo seleccionado
	var id_articulo = $("#idArticulo").val();
	$.ajax({
		url: base_url + "/ventas_controller/getDatosArticulo",
		type:"POST",
		dataType: "json",
		data:{id:id_articulo},
		success:function(result){
			// console.log(result);
			if(parseInt($("#cantidad").val()) > result.existencia) {
				$("#msg-error").show();
				setTimeout(function(){ $("#msg-error").hide(); }, 2500);
				$("#texto-error").text("Solo hay " + result.existencia + " artículos en existencia.");
				return;
			}
			var importe = $('#cantidad').val() * result.precio;
		  	var gridDetalles = $('#grid_detalles_venta').DataTable();
			gridDetalles.row.add( [
		       result.id,
		       result.descripcion,
		       result.modelo,
		       $('#cantidad').val(),
		       result.precio,
		       importe.toFixed(2),
		    ] ).draw( false );
			$("#cantidad").val("");
			$("#id_articulo").val("").trigger('chosen:updated');
   			calcularTotales();
		}
	});
}


// Calcular Total de Compra
var calcularTotales = function() {
	var gridDetalles = $('#grid_detalles_venta').DataTable();
	var numRows = gridDetalles.rows().count();
	var importe = 0;
	var enganche = 0;
	var bonificacion = 0;
	var totalAdeudo = 0;

	for(var i = 0; i < numRows; i++) {
		importe += parseFloat(gridDetalles.cell(i,5).data());
	}

	$.ajax({
		url: base_url + "/ventas_controller/getConfiguracion",
		type:"POST",
		dataType: "json",
		success:function(result){
			// Calcular Enganche, Bonificación y Total adeudo
			enganche = (result.enganche / 100) * importe;
			bonificacion = enganche * ((result.tasa_financiamiento * result.plazo_maximo) / 100)
			totalAdeudo = importe - enganche - bonificacion;
			$('#lblEnganche').text(enganche.toFixed(2));
			$('#lblBonificacion').text(bonificacion.toFixed(2));
			$('#lblTotal').text(totalAdeudo.toFixed(2));

			// Calcular las mensualidades por plazo
			var tablaPlazos = document.getElementById("tabla_plazos");
			var numRows = tablaPlazos.rows.length;
			var precio_contado = 0;
			var total_credito  = 0;
			var importe_abono  = 0;
			var importe_ahorro = 0;
			var plazo = 3;

			precio_contado = totalAdeudo / (1 + ((result.tasa_financiamiento * result.plazo_maximo) / 100) );	

			for(var i = 1; i<numRows; i++) {
				total_credito  = precio_contado * (1 + (result.tasa_financiamiento * plazo) / 100);
				importe_abono  = total_credito / plazo;
				importe_ahorro = totalAdeudo - total_credito;

				tablaPlazos.rows[i].cells[1].innerHTML = "$" + importe_abono.toFixed(2);
				tablaPlazos.rows[i].cells[2].innerHTML = "Total a pagar $" + total_credito.toFixed(2);
				tablaPlazos.rows[i].cells[3].innerHTML = "Se ahorra $" + importe_ahorro.toFixed(2);
				plazo += 3;
			}
		}
	});
}


// Limpiar el registro de Venta
function limpiarVenta(){	
	$("#ventas_activas").show();
	$("#registro_venta").hide();
    $('#tabla_plazos').hide();
	$('#btnRegistrarVenta').hide();
	$('#btnSiguiente').show();
	$("input[type='radio']:checked").prop('checked', false);
	var gridDetalles = $('#grid_detalles_venta').DataTable();
    $('#id_cliente').val("").trigger('chosen:updated');
    $('#rfc').val("");
    $('#lblEnganche').text("0.00");
    $('#lblBonificacion').text("0.00");
    $('#lblTotal').text("0.00");
    gridDetalles.rows().remove().draw(false);
}


// Validar Existencia del producto seleccionado
function validarExistecia(){
	var id_articulo = $("#id_articulo").val();
	$.ajax({
		url: base_url + "/ventas_controller/getDatosArticulo",
		type:"POST",
		dataType: "json",
		data:{id:id_articulo},
		success:function(result){
			if(result.existencia == 0) {
				$("#id_articulo").val("").trigger('chosen:updated');
				$("#msg-error").show();
				setTimeout(function(){ $("#msg-error").hide(); }, 3000);
				$("#texto-error").text("El artículo seleccionado no cuenta con existencia, favor de verificar");
				return;
			}
		}
	});
}


// Mostrar Tabla de los abonos en los distintos plazos
function mostrarAbonos(){
	if($("#id_cliente").val() == "") {
		$("#msg-error").show();
		setTimeout(function(){ $("#msg-error").hide(); }, 2500);			
		$("#texto-error").text("Por favor, selecciona el cliente.");
		return;
	}	
	var numDetalles = $('#grid_detalles_venta').DataTable().rows().count();
	if(numDetalles <= 0) {
		$("#msg-error").show();
		setTimeout(function(){ $("#msg-error").hide(); }, 3000);			
		$("#texto-error").text("Aun no has agregado artículos a la venta.");
		return;
	}
    $('#btnSiguiente').hide();
    $('#btnRegistrarVenta').show();
    $('#tabla_plazos').show();
}


// Registrar Venta
function registrarVenta(){
	// console.log($("input[type='radio']:checked").val());return;
	if($("#id_cliente").val() == "") {
		$("#msg-error2").show();
		setTimeout(function(){ $("#msg-error2").hide(); }, 2500);			
		$("#texto-error2").text("Por favor, selecciona el cliente.");
		return;
	}	
	var numDetalles = $('#grid_detalles_venta').DataTable().rows().count();
	if(numDetalles <= 0) {
		$("#msg-error2").show();
		setTimeout(function(){ $("#msg-error2").hide(); }, 3000);			
		$("#texto-error2").text("Aun no has agregado artículos a la venta.");
		return;
	}
	if($("input[type='radio']:checked").val() == "" || $("input[type='radio']:checked").val() == undefined) {
		$("#msg-error2").show();
		setTimeout(function(){ $("#msg-error2").hide(); }, 2500);			
		$("#texto-error2").text("Por favor, selecciona un plazo.");
		return;
	}

	var tablaPlazos = document.getElementById("tabla_plazos");
	var numRows = tablaPlazos.rows.length;
	var mensualidad = 0;
	var j = 3;

	for(var i = 1; i<numRows; i++) {
		if(j == $('input[type="radio"]:checked').val()){
			mensualidad = tablaPlazos.rows[i].cells[1].innerHTML.replace("$","");
		}
		j += 3;
	}

	var datos = {};
	datos.detalles = [];
	datos.generales = {
		id 				: 	$('#lblFolio').text(),
		id_cliente 		: 	$('#id_cliente').val(),
		enganche		: 	$('#lblEnganche').text(),
		bonificacion 	: 	$('#lblBonificacion').text(),
		total_adeudo 	: 	$('#lblTotal').text(),
		plazo 			: 	$('input[type="radio"]:checked').val(),
		mensualidad 	: 	mensualidad
	};

	var gridDetalles = $('#grid_detalles_venta').DataTable();
	for(var i = 0; i < numDetalles; i++) {
		datos.detalles[i] = {
			id_articulo : gridDetalles.cell(i,0).data(),
			precio 		: gridDetalles.cell(i,4).data(),
			cantidad	: gridDetalles.cell(i,3).data(),
			importe 	: gridDetalles.cell(i,5).data()
		};
	}

	// console.log(datos);return;
	$.ajax({
		url: base_url + "/ventas_controller/registrarVenta",
		type:"POST",
		data:datos,
		success:function(respuesta){
			if (respuesta == "OK") {
				var gridVentas = $('#grid_ventas').DataTable();				
				gridVentas.ajax.reload( null, false );
				limpiarVenta();
				$("#msg-ok1").show();
				$("#texto-ok1").text("La Venta se ha registrado correctamente");
				setTimeout(function(){ $("#msg-ok1").hide(); }, 3000);
			}
			else if (respuesta == "Error") {
				$("#msg-error1").show();				
				$("#texto-error1").text("Error. No se pudo registrar la Venta");
				setTimeout(function(){ $("#msg-error1").hide(); }, 3000);
				return;	
			}
		}
	});
}