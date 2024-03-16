@extends ("layouts.menu")
@section("scriptsCSS")
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section("content")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
       <section class="content">
          <!-- Default box -->
          <div class="card">
             <div class="card-body">
                <div class="jumbotron" style="padding-bottom: 2%">
                   <h1>Calendario de Juegos de Equipos</h1>
                </div>
                <ol class="breadcrumb float-sm-left"> 
                    
                    @if(\Session::has('error'))
                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                    @endif
                    @if(\Session::has('success'))
                        <div class="alert alert-success">{{ \Session::get('success') }}</div>
                        {{ \Session::forget('success') }}
                    @endif
                </ol>
             </div>
             <!-- /.card-body -->
          </div>
          <!-- /.card -->
       </section>
       <!-- /.content -->           
    </div>
    <!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
       <!-- Default box -->
       <div class="card">
          <div class="card-header">
             <h3 class="card-title"></h3>
             <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>                
             </div>
          </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="jambo_table table table-hover" id="tbl_calendario_partidos" border=1>
                   <thead >
                      <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                         <th scope="col">id</th>
                         <th scope="col">Encuentro</th>
                         <th scope="col">Precio</th>
                         <th scope="col">Fecha y hora inicio</th>
                         <th scope="col">Fecha y hora fin</th>
                         <th scope="col">Opciones</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($calendario_partidos_list as $row)
                      <tr style="font-size: medium">
                         <td scope="row">{{$row->id}}</td>
                         <td scope="row">{{$row->encuentro}}</td>
                         <td scope="row">$ {{$row->precio}}</td>
                         <td scope="row">{{$row->fecha_hora_inicio}}</td>
                         <td scope="row">{{$row->fecha_hora_fin}}</td>
                         <td>
                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal_calendario_partidos"
                               data-id="{{$row->id}}"
                               data-encuentro="{{$row->encuentro}}"
                               data-precio="{{$row->precio}}"
                               data-fecha_hora_inicio="{{$row->fecha_hora_inicio}}"
                               data-fecha_hora_fin="{{$row->fecha_hora_fin}}"
                               ><i class="fa fa-edit"></i></button>
                               <div id="paypal-button-container" style="max-width:1000px;"></div>
                               --}}
                               
                               @if(!$row->pago_partido)
                               <a class="btn btn-primary m-3" href="{{url('process-transaction/'.$row->id)}}" title="Realizar pago!">
                                   <i class="fa fa-money">
                                       
                                       <svg xmlns="http://www.w3.org/2000/svg" height="70" width="80" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#e2e5e9" d="M186.3 258.2c0 12.2-9.7 21.5-22 21.5-9.2 0-16-5.2-16-15 0-12.2 9.5-22 21.7-22 9.3 0 16.3 5.7 16.3 15.5zM80.5 209.7h-4.7c-1.5 0-3 1-3.2 2.7l-4.3 26.7 8.2-.3c11 0 19.5-1.5 21.5-14.2 2.3-13.4-6.2-14.9-17.5-14.9zm284 0H360c-1.8 0-3 1-3.2 2.7l-4.2 26.7 8-.3c13 0 22-3 22-18-.1-10.6-9.6-11.1-18.1-11.1zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM128.3 215.4c0-21-16.2-28-34.7-28h-40c-2.5 0-5 2-5.2 4.7L32 294.2c-.3 2 1.2 4 3.2 4h19c2.7 0 5.2-2.9 5.5-5.7l4.5-26.6c1-7.2 13.2-4.7 18-4.7 28.6 0 46.1-17 46.1-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.2 8.2-5.8-8.5-14.2-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9 0 20.2-4.9 26.5-11.9-.5 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H200c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm40.5 97.9l63.7-92.6c.5-.5 .5-1 .5-1.7 0-1.7-1.5-3.5-3.2-3.5h-19.2c-1.7 0-3.5 1-4.5 2.5l-26.5 39-11-37.5c-.8-2.2-3-4-5.5-4h-18.7c-1.7 0-3.2 1.8-3.2 3.5 0 1.2 19.5 56.8 21.2 62.1-2.7 3.8-20.5 28.6-20.5 31.6 0 1.8 1.5 3.2 3.2 3.2h19.2c1.8-.1 3.5-1.1 4.5-2.6zm159.3-106.7c0-21-16.2-28-34.7-28h-39.7c-2.7 0-5.2 2-5.5 4.7l-16.2 102c-.2 2 1.3 4 3.2 4h20.5c2 0 3.5-1.5 4-3.2l4.5-29c1-7.2 13.2-4.7 18-4.7 28.4 0 45.9-17 45.9-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.3 8.2-5.5-8.5-14-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9.3 0 20.5-4.9 26.5-11.9-.3 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H484c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm47.5-33.3c0-2-1.5-3.5-3.2-3.5h-18.5c-1.5 0-3 1.2-3.2 2.7l-16.2 104-.3 .5c0 1.8 1.5 3.5 3.5 3.5h16.5c2.5 0 5-2.9 5.2-5.7L544 191.2v-.3zm-90 51.8c-12.2 0-21.7 9.7-21.7 22 0 9.7 7 15 16.2 15 12 0 21.7-9.2 21.7-21.5 .1-9.8-6.9-15.5-16.2-15.5z"/></svg>
                                   </i>
                               </a>
                               @else
                               PAGO REALIZADO, VER PARTIDO
                               @endif
                               
                         </td>
                      </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer-->
       </div>
       <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
 </section>
 
 <!-- /.content --> 
 <div id="modal_calendario_partidos" class="modal fade"  role="dialog" aria-labelledby="modal_calendario_partidos" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Calendario de Juegos de Equipos</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                   <label class="">Encuentro</label>		
                   <input type="text" class="form-control" id="encuentro" name="encuentro">
                </div>
                <div class="form-group">
                   <label class="">Precio</label>		
                   <input type="number" class="form-control validatornumber" id="precio" name="precio">
                </div>
                <div class="form-group">
                   <label class="">Fecha y hora inicio</label>		
                   <input type="text" class="form-control timestamp" id="fecha_hora_inicio" name="fecha_hora_inicio">
                </div>
                <div class="form-group">
                   <label class="">Fecha y hora fin</label>		
                   <input type="text" class="form-control timestamp" id="fecha_hora_fin" name="fecha_hora_fin">
                </div>
             </form>
          </div>
          <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button> 
             <button type="button" id="btn_guardar_calendario_partidos" class="btn btn-primary antosubmit2">Guardar</button>
          </div>
       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->  
 <div id="modal_eliminar_calendario_partidos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_calendario_partidos aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Eliminar Registro</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                   <label class="control-label" style="font-size: 20px">¿Seguro que desea eliminar este registro?</label>
                </div>
             </form>
          </div>
          <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
             <button type="button" id="btn_eliminar_calendario_partidos" class="btn btn-danger antosubmit2">Eliminar</button>
          </div>
       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->
 <div id="modal_eliminar_calendario_partidos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_calendario_partidos aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Activar Registro</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                   <label class="control-label" style="font-size: 20px">¿Seguro que desea activar este registro?</label>
                </div>
             </form>
          </div>
          <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
             <button type="button" id="btn_activar_calendario_partidos" class="btn btn-primary antosubmit2">Activar</button>
          </div>
       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->

@endsection
@section("scripts")

<!--<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>-->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_LIVE_CLIENT_ID') }}"></script>

<script type="text/javascript">
var accion=null;
var id=null;
var encuentro=null;
var precio=null;
var fecha_hora_inicio=null;
var fecha_hora_fin=null;
var url_guardar_calendario_partidos= "{{url('create-transaction')}}/guardar";
var table=null;
var rowNumber=null;
$(document).ready(function () {
 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});	

	$('.timestamp').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		timePicker: true,
		timePicker24Hour: true,
		minYear: 1901,                    
		"locale": {
			"monthNames": monthNames,
			"daysOfWeek": daysOfWeek,
			"applyLabel": "Aplicar",
			"cancelLabel": "Cancelar",
			"fromLabel": "Desde",
			"toLabel": "Hasta",
			format: 'YYYY-MM-DD HH:mm'
		},
	  });
/*
      paypal.Buttons({
        style: {
    layout: 'vertical',
    color:  'blue',
    shape:  'rect',
    label:  'paypal'
  },
  }).render('#paypal-button-container');
*/


	$('.validatornumber').keypress(function (){

		var keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum == 8) || (keynum == 46))
			return true;

		return /\d/.test(String.fromCharCode(keynum));
	});

table=$("#tbl_calendario_partidos" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [
	
]
});
 

	
$("#modal_calendario_partidos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
encuentro=triggerLink.data("encuentro");
precio=triggerLink.data("precio");
fecha_hora_inicio=triggerLink.data("fecha_hora_inicio");
fecha_hora_fin=triggerLink.data("fecha_hora_fin");
$("#id").val(id);
$("#encuentro").val(encuentro);
$("#precio").val(precio);
$("#fecha_hora_inicio").val(fecha_hora_inicio);
$("#fecha_hora_fin").val(fecha_hora_fin);
});
  
$("#modal_eliminar_calendario_partidos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
encuentro=triggerLink.data("encuentro");
precio=triggerLink.data("precio");
fecha_hora_inicio=triggerLink.data("fecha_hora_inicio");
fecha_hora_fin=triggerLink.data("fecha_hora_fin");
$("#id").val(id);
$("#encuentro").val(encuentro);
$("#precio").val(precio);
$("#fecha_hora_inicio").val(fecha_hora_inicio);
$("#fecha_hora_fin").val(fecha_hora_fin);
accion=3;
});
  
$("#modal_activar_calendario_partidos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
encuentro=triggerLink.data("encuentro");
precio=triggerLink.data("precio");
fecha_hora_inicio=triggerLink.data("fecha_hora_inicio");
fecha_hora_fin=triggerLink.data("fecha_hora_fin");
$("#id").val(id);
$("#encuentro").val(encuentro);
$("#precio").val(precio);
$("#fecha_hora_inicio").val(fecha_hora_inicio);
$("#fecha_hora_fin").val(fecha_hora_fin);
accion=4;
});
  
$("#tbl_calendario_partidos tbody").on( "click", "tr", function () {
rowNumber=parseInt(table.row( this ).index());
accion=2;
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_calendario_partidos", function () {
encuentro=$("#encuentro").val();
precio=$("#precio").val();
fecha_hora_inicio=$("#fecha_hora_inicio").val();
fecha_hora_fin=$("#fecha_hora_fin").val();
 
	if(encuentro== null || encuentro == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Encuentro',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(precio== null || precio == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Precio',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(fecha_hora_inicio== null || fecha_hora_inicio == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Fecha y hora inicio',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(fecha_hora_fin== null || fecha_hora_fin == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Fecha y hora fin',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
preguardar_calendario_partidos();
});
});
$(".modal-footer").on("click", "#btn_eliminar_calendario_partidos", function () {
guardar_calendario_partidos();
});
$(".modal-footer").on("click", "#btn_activar_calendario_partidos", function () {
guardar_calendario_partidos();
});

	function preguardar_calendario_partidos() {
              
              var indexUploadCoincidence=0;
              
$.when(


                ).done(function (){
                  guardar_calendario_partidos();
                } )
                ;
              }
	
  
function guardar_calendario_partidos(){
$.ajax({
type: "post",
url:url_guardar_calendario_partidos,
data: {
 "id": id,
 "encuentro": encuentro,
 "precio": precio,
 "fecha_hora_inicio": fecha_hora_inicio,
 "fecha_hora_fin": fecha_hora_fin,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_calendario_partidos").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_calendario_partidos").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_calendario_partidos").modal("hide");
for(var i = 0; i < data.calendario_partidos_list.length; i++) {
var row= data.calendario_partidos_list[i];
var nuevaFilaDT=[
row.id,row.encuentro,row.precio,row.fecha_hora_inicio,row.fecha_hora_fin
 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_calendario_partidos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-encuentro="'+row.encuentro+'" '+ 
 'data-precio="'+row.precio+'" '+ 
 'data-fecha_hora_inicio="'+row.fecha_hora_inicio+'" '+ 
 'data-fecha_hora_fin="'+row.fecha_hora_fin+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_calendario_partidos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-encuentro="'+row.encuentro+'" '+ 
 'data-precio="'+row.precio+'" '+ 
 'data-fecha_hora_inicio="'+row.fecha_hora_inicio+'" '+ 
 'data-fecha_hora_fin="'+row.fecha_hora_fin+'" '+ 
 '><i class="fa fa-trash"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_calendario_partidos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-encuentro="'+row.encuentro+'" '+ 
 'data-precio="'+row.precio+'" '+ 
 'data-fecha_hora_inicio="'+row.fecha_hora_inicio+'" '+ 
 'data-fecha_hora_fin="'+row.fecha_hora_fin+'" '+ 
 '><i class="fa fa-check-circle"></i></button>'+ 
''
];
if(accion==1) {
	$("#modal_calendario_partidos").modal("hide");
		table.row.add(nuevaFilaDT).draw();
	}else if (accion==2) {
		$("#modal_calendario_partidos").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}else if (accion==4) {
		$("#modal_activar_calendario_partidos").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}
}
 if (accion == 3){
     $("#modal_eliminar_calendario_partidos").modal("hide");
     table.row(rowNumber).data(nuevaFilaDT);
} 
}

new PNotify({
title: titleMsg,
text: textMsg,
type: typeMsg,
shadow: true
});

},
error: function (xhr, status, error) {
alert(xhr.responseText);
}
});
}
   
</script>
@endsection
