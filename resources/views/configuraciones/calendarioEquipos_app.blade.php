@extends ("layouts.menu2")
@section("scriptsCSS")
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
                        
                         <th scope="col">Encuentro</th>
                       
                         <th scope="col">precio</th>
                         <th scope="col">fecha hora</th>
                         
                         <th scope="col">Opciones</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($calendario_partidos_list as $row)
                      <tr style="font-size: medium">
                        
                         <td scope="row">{{$row->encuentro}}</td>
                       
                         <td scope="row">{{$row->precio}}</td>
                         <td scope="row">{{$row->fecha_hora_inicio}}</td>
                         
                         <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_calendario_partidos"
                               data-id="{{$row->id}}"
                               data-id_equipo="{{$row->id_equipo}}"
                               data-id_equipo_2="{{$row->id_equipo_2}}"
                               data-precio="{{$row->precio}}"
                               data-encuentro="{{$row->encuentro}}"
                               data-fecha_hora_inicio="{{$row->fecha_hora_inicio}}"
                               data-fecha_hora_fin="{{$row->fecha_hora_fin}}"
                               data-equipo="{{$row->equipo}}"
                               data-equipo_2="{{$row->equipo_2}}"
                               ><i class="fa fa-edit"></i></button>
                            &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_calendario_partidos"
                               data-id="{{$row->id}}"
                               data-id_equipo="{{$row->id_equipo}}"
                               data-encuentro="{{$row->encuentro}}"
                               data-id_equipo_2="{{$row->id_equipo_2}}"
                               data-precio="{{$row->precio}}"
                               data-fecha_hora_inicio="{{$row->fecha_hora_inicio}}"
                               data-fecha_hora_fin="{{$row->fecha_hora_fin}}"
                               data-equipo="{{$row->equipo}}"
                               data-equipo_2="{{$row->equipo_2}}"
                               ><i class="fa fa-trash"></i></button>
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
                   <label class="">Equipo</label>		
                   <select id="id_equipo" name="id_equipo" class="select2_single form-control country" >
                      <option></option>
                      @foreach ($equipo_list as $equipo)
                      <option value="{{$equipo->id}}">{{$equipo->nombre}}</option>
                      @endforeach
                   </select>
                </div>
                <div class="form-group">
                   <label class="">Segundo Equipo</label>		
                   <select id="id_equipo_2" name="id_equipo_2" class="select2_single form-control country" >
                      <option></option>
                      @foreach ($equipo_2_list as $equipo_2)
                      <option value="{{$equipo_2->id}}">{{$equipo_2->nombre}}</option>
                      @endforeach
                   </select>
                </div>
                <div class="form-group">
                   <label class="">precio</label>		
                   <input type="number" class="form-control validatornumber" id="precio" name="precio">
                </div>
                {{-- <div class="form-group">
                   <label class="">fecha y hora inicio</label>		
                   <input type="text" class="form-control timestamp" id="fecha_hora_inicio" name="fecha_hora_inicio">
                </div>
                <div class="form-group">
                   <label class="">fecha y hora fin</label>		
                   <input type="text" class="form-control timestamp" id="fecha_hora_fin" name="fecha_hora_fin">
                </div> --}}

                <div class="form-group">
                    <label>fecha y hora inicio</label>
                    <div class="input-group date" id="fecha_hora_inicio_datetime" data-target-input="nearest">
                       <input type="text" id="fecha_hora_inicio" name="fecha_hora_inicio" class="form-control datetimepicker-input" data-target="#fecha_hora_inicio_datetime">
                       <div class="input-group-append" data-target="#fecha_hora_inicio_datetime" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                       </div>
                    </div>
                 </div>
                
                 <div class="form-group">
                    <label>fecha y hora fin</label>
                    <div class="input-group date" id="fecha_hora_fin_datetime" data-target-input="nearest">
                       <input type="text" id="fecha_hora_fin" name="fecha_hora_fin" class="form-control datetimepicker-input" data-target="#fecha_hora_fin_datetime">
                       <div class="input-group-append" data-target="#fecha_hora_fin_datetime" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                       </div>
                    </div>
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
  
<script type="text/javascript">
var accion=null;
var id=null;
var id_equipo=null;
var id_equipo_2=null;
var precio=null;
var fecha_hora_inicio=null;
var fecha_hora_fin=null;
var url_guardar_calendario_partidos= "{{url('/configuracion/calendario/equipos')}}/guardar/app";
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



    $('#fecha_hora_inicio_datetime').datetimepicker({
        icons: { time: 'far fa-clock' },
        format: 'YYYY-MM-DD HH:mm',
        locale: 'es-mx'           
    });

    $('#fecha_hora_fin_datetime').datetimepicker({
        icons: { time: 'far fa-clock' },
        format: 'YYYY-MM-DD HH:mm',
        locale: 'es-mx'           
    });
    

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
	{
		text: "<i class='fas fa-plus'></i> Agregar",
	    className: 'btn btn-block btn-default',  
		action: function ( e, dt, node, config ) {
			accion=1;
			$("#modal_calendario_partidos").modal("show");
		}
	}
]
});
 

	
$("#modal_calendario_partidos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
id_equipo=triggerLink.data("id_equipo");
id_equipo_2=triggerLink.data("id_equipo_2");
precio=triggerLink.data("precio");
fecha_hora_inicio=triggerLink.data("fecha_hora_inicio");
fecha_hora_fin=triggerLink.data("fecha_hora_fin");
$("#id").val(id);
$("#id_equipo").val(id_equipo);
$("#id_equipo_2").val(id_equipo_2);
$("#precio").val(precio);
$("#fecha_hora_inicio").val(fecha_hora_inicio);
$("#fecha_hora_fin").val(fecha_hora_fin);
});
  
$("#modal_eliminar_calendario_partidos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
id_equipo=triggerLink.data("id_equipo");
id_equipo_2=triggerLink.data("id_equipo_2");
precio=triggerLink.data("precio");
fecha_hora_inicio=triggerLink.data("fecha_hora_inicio");
fecha_hora_fin=triggerLink.data("fecha_hora_fin");
$("#id").val(id);
$("#id_equipo").val(id_equipo);
$("#id_equipo_2").val(id_equipo_2);
$("#precio").val(precio);
$("#fecha_hora_inicio").val(fecha_hora_inicio);
$("#fecha_hora_fin").val(fecha_hora_fin);
accion=3;
});
  
$("#modal_activar_calendario_partidos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
id_equipo=triggerLink.data("id_equipo");
id_equipo_2=triggerLink.data("id_equipo_2");
precio=triggerLink.data("precio");
fecha_hora_inicio=triggerLink.data("fecha_hora_inicio");
fecha_hora_fin=triggerLink.data("fecha_hora_fin");
$("#id").val(id);
$("#id_equipo").val(id_equipo);
$("#id_equipo_2").val(id_equipo_2);
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
id_equipo=$("#id_equipo").val();
id_equipo_2=$("#id_equipo_2").val();
precio=$("#precio").val();
fecha_hora_inicio=$("#fecha_hora_inicio").val();
fecha_hora_fin=$("#fecha_hora_fin").val();
 
	if(id_equipo== null || id_equipo == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Equipo',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(id_equipo_2== null || id_equipo_2 == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Segundo Equipo',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(precio== null || precio == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para precio',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(fecha_hora_inicio== null || fecha_hora_inicio == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para fecha y hora inicio',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	if(fecha_hora_fin== null || fecha_hora_fin == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para fecha y hora fin',
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
 "id_equipo": id_equipo,
 "id_equipo_2": id_equipo_2,
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
row.encuentro,row.precio,row.fecha_hora_inicio
 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_calendario_partidos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-id_equipo="'+row.id_equipo+'" '+ 
 'data-id_equipo_2="'+row.id_equipo_2+'" '+ 
 'data-precio="'+row.precio+'" '+ 
 'data-encuentro="'+row.encuentro+'" '+
 'data-fecha_hora_inicio="'+row.fecha_hora_inicio+'" '+ 
 'data-fecha_hora_fin="'+row.fecha_hora_fin+'" '+ 
 'data-equipo="'+row.equipo+'" '+ 
 'data-equipo_2="'+row.equipo_2+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_calendario_partidos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-id_equipo="'+row.id_equipo+'" '+ 
 'data-id_equipo_2="'+row.id_equipo_2+'" '+ 
 'data-precio="'+row.precio+'" '+ 
 'data-encuentro="'+row.encuentro+'" '+
 'data-fecha_hora_inicio="'+row.fecha_hora_inicio+'" '+ 
 'data-fecha_hora_fin="'+row.fecha_hora_fin+'" '+ 
 'data-equipo="'+row.equipo+'" '+ 
 'data-equipo_2="'+row.equipo_2+'" '+ 
 '><i class="fa fa-trash"></i></button>'+ 
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
     //table.row(rowNumber).data(nuevaFilaDT);
     table.row(rowNumber).remove().draw();
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
