@extends ("layouts.menu")
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
                   <h1>Personas</h1>
                </div>
                <ol class="breadcrumb float-sm-left"> 
                <!--  <a class="btn btn-primary" href="" title='Regresar'><i class="fa fa-download"></i> </a>     -->                       
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
                <table class="jambo_table table table-hover" id="tbl_reg_ficha_personas" border=1>
                   <thead >
                      <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                         <th scope="col">Id</th>
                         <th scope="col">identidad</th>
                         <th scope="col">Nombre Completo</th>
                         <th scope="col">Fecha nacimiento</th>
                         <th scope="col">Sexo</th>
                         <th scope="col">Telefono</th>
                         <th scope="col">Domicilio</th>
                         <th scope="col">Opciones</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($reg_ficha_personas_list as $row)
                      <tr style="font-size: medium">
                         <td scope="row">{{$row->id}}</td>
                         <td scope="row">{{$row->identidad}}</td>
                         <td scope="row">{{$row->nombre_persona}}</td>
                         <td scope="row">{{$row->fecha_nacimiento}}</td>
                         <td scope="row">{{$row->sexo}}</td>
                         <td scope="row">{{$row->telefono}}</td>
                         <td scope="row">{{$row->domicilio}}</td>
                         
                         <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_reg_ficha_personas"
                               data-id="{{$row->id}}"
                               data-identidad="{{$row->identidad}}"
                               data-nombre_persona="{{$row->nombre_persona}}"
                               data-primer_nombre="{{$row->primer_nombre}}"
                               data-segundo_nombre="{{$row->segundo_nombre}}"
                               data-primer_apellido="{{$row->primer_apellido}}"
                               data-segundo_apellido="{{$row->segundo_apellido}}"
                               data-fecha_nacimiento="{{$row->fecha_nacimiento}}"
                               data-sexo="{{$row->sexo}}"
                               data-telefono="{{$row->telefono}}"
                               data-id_pais_nacimiento="{{$row->id_pais_nacimiento}}"
                               data-domicilio="{{$row->domicilio}}"
                               data-sexo="{{$row->sexo}}"
                               data-pais_nacimiento="{{$row->pais_nacimiento}}"
                               title="Editar"
                               ><i class="fa fa-edit"></i></button>
                            &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_reg_ficha_personas"
                               data-id="{{$row->id}}"
                               data-identidad="{{$row->identidad}}"
                               data-primer_nombre="{{$row->primer_nombre}}"
                               data-segundo_nombre="{{$row->segundo_nombre}}"
                               data-primer_apellido="{{$row->primer_apellido}}"
                               data-segundo_apellido="{{$row->segundo_apellido}}"
                               data-fecha_nacimiento="{{$row->fecha_nacimiento}}"
                               data-sexo="{{$row->sexo}}"
                               data-telefono="{{$row->telefono}}"
                               data-id_pais_nacimiento="{{$row->id_pais_nacimiento}}"
                               data-domicilio="{{$row->domicilio}}"
                               data-sexo="{{$row->sexo}}"
                               data-pais_nacimiento="{{$row->pais_nacimiento}}"
                               title="Eliminar"
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
 <div id="modal_reg_ficha_personas" class="modal fade"  role="dialog" aria-labelledby="modal_reg_ficha_personas" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Personas</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form id="antoform2" class="form-horizontal calender" role="form">

                <div class="form-group row">
                    <div class="form-group col-6">
                        <label class="">Identidad</label>		
                        <input type="text" class="form-control" id="identidad" name="identidad">
                    </div>
                        
                    <div class="form-group col-6">
                        <label class="">Primer nombre</label>		
                        <input type="text" class="form-control" id="primer_nombre" name="primer_nombre">
                    </div>
                </div> 
                
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label class="">Segundo nombre</label>		
                        <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                    </div>
                        
                    <div class="form-group col-6">
                        <label class="">Primer apellido</label>		
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label class="">Segundo apellido</label>		
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                    </div>
                        
                    <div class="form-group col-6">
                        <label class="">Fecha nacimiento</label>		
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label class="">Sexo</label>		
                        <select id="sexo" name="sexo" class="select2_single form-control country" >
                            <option></option>
                            @foreach ($sexo_list as $sexo)
                            <option value="{{$sexo->sexo}}">{{$sexo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                        
                    <div class="form-group col-6">
                        <label class="">Telefono</label>		
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label class="">Pais nacimiento</label>		
                        <select id="id_pais_nacimiento" name="id_pais_nacimiento" class="select2_single form-control country" >
                            <option></option>
                            @foreach ($pais_nacimiento_list as $pais_nacimiento)
                            <option value="{{$pais_nacimiento->id}}">{{$pais_nacimiento->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                        
                    <div class="form-group col-6">
                        <label class="">Domicilio</label>		
                        <input type="text" class="form-control" id="domicilio" name="domicilio">
                    </div>
                </div>
                

             </form>
          </div>
          <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button> 
             <button type="button" id="btn_guardar_reg_ficha_personas" class="btn btn-primary antosubmit2">Guardar</button>
          </div>
       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->  
 <div id="modal_eliminar_reg_ficha_personas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_reg_ficha_personas aria-hidden="true">
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
             <button type="button" id="btn_eliminar_reg_ficha_personas" class="btn btn-danger antosubmit2">Eliminar</button>
          </div>
       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->
 <div id="modal_eliminar_reg_ficha_personas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_reg_ficha_personas aria-hidden="true">
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
             <button type="button" id="btn_activar_reg_ficha_personas" class="btn btn-primary antosubmit2">Activar</button>
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
var identidad=null;
var primer_nombre=null;
var segundo_nombre=null;
var primer_apellido=null;
var segundo_apellido=null;
var fecha_nacimiento=null;
var fecha_defuncion = null;
var id_estado_sindicato = null;
var sexo=null;
var telefono=null;
var id_pais_nacimiento=null;
var domicilio=null;
var url_guardar_reg_ficha_personas= "{{url('/personas')}}/guardar";
var table=null;
var rowNumber=null;
var uri= "{{url('')}}";
$(document).ready(function () {
 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});	

	$('.date').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,                    
		"locale": {
			"monthNames": monthNames,
			"daysOfWeek": daysOfWeek,
			"applyLabel": "Aplicar",
			"cancelLabel": "Cancelar",
			"fromLabel": "Desde",
			"toLabel": "Hasta",
			format: 'YYYY-MM-DD'
		},
	  });

table=$("#tbl_reg_ficha_personas" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [
	{
		text: "<i class='fas fa-plus'></i> Agregar",
	    className: 'btn btn-block btn-default',  
		action: function ( e, dt, node, config ) {
			accion=1;
			$("#modal_reg_ficha_personas").modal("show");
		}
	}
]
});
 

	
$("#modal_reg_ficha_personas").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
identidad=triggerLink.data("identidad");
primer_nombre=triggerLink.data("primer_nombre");
segundo_nombre=triggerLink.data("segundo_nombre");
primer_apellido=triggerLink.data("primer_apellido");
segundo_apellido=triggerLink.data("segundo_apellido");
fecha_nacimiento=triggerLink.data("fecha_nacimiento");
sexo=triggerLink.data("sexo");
telefono=triggerLink.data("telefono");
id_pais_nacimiento=triggerLink.data("id_pais_nacimiento");
domicilio=triggerLink.data("domicilio");


$("#id").val(id);
$("#identidad").val(identidad);
$("#primer_nombre").val(primer_nombre);
$("#segundo_nombre").val(segundo_nombre);
$("#primer_apellido").val(primer_apellido);
$("#segundo_apellido").val(segundo_apellido);
$("#fecha_nacimiento").val(fecha_nacimiento);
$("#sexo").val(sexo);
$("#telefono").val(telefono);
$("#id_pais_nacimiento").val(id_pais_nacimiento);
$("#domicilio").val(domicilio);

});
  
$("#modal_eliminar_reg_ficha_personas").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
identidad=triggerLink.data("identidad");
primer_nombre=triggerLink.data("primer_nombre");
segundo_nombre=triggerLink.data("segundo_nombre");
primer_apellido=triggerLink.data("primer_apellido");
segundo_apellido=triggerLink.data("segundo_apellido");
fecha_nacimiento=triggerLink.data("fecha_nacimiento");
sexo=triggerLink.data("sexo");
telefono=triggerLink.data("telefono");
id_pais_nacimiento=triggerLink.data("id_pais_nacimiento");
domicilio=triggerLink.data("domicilio");

$("#id").val(id);
$("#identidad").val(identidad);
$("#primer_nombre").val(primer_nombre);
$("#segundo_nombre").val(segundo_nombre);
$("#primer_apellido").val(primer_apellido);
$("#segundo_apellido").val(segundo_apellido);
$("#fecha_nacimiento").val(fecha_nacimiento);
$("#sexo").val(sexo);
$("#telefono").val(telefono);
$("#id_pais_nacimiento").val(id_pais_nacimiento);
$("#domicilio").val(domicilio);
accion=3;
});
  
$("#modal_activar_reg_ficha_personas").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
identidad=triggerLink.data("identidad");
primer_nombre=triggerLink.data("primer_nombre");
segundo_nombre=triggerLink.data("segundo_nombre");
primer_apellido=triggerLink.data("primer_apellido");
segundo_apellido=triggerLink.data("segundo_apellido");
fecha_nacimiento=triggerLink.data("fecha_nacimiento");
sexo=triggerLink.data("sexo");
telefono=triggerLink.data("telefono");
id_pais_nacimiento=triggerLink.data("id_pais_nacimiento");
domicilio=triggerLink.data("domicilio");

$("#id").val(id);
$("#identidad").val(identidad);
$("#primer_nombre").val(primer_nombre);
$("#segundo_nombre").val(segundo_nombre);
$("#primer_apellido").val(primer_apellido);
$("#segundo_apellido").val(segundo_apellido);
$("#fecha_nacimiento").val(fecha_nacimiento);
$("#sexo").val(sexo);
$("#telefono").val(telefono);
$("#id_pais_nacimiento").val(id_pais_nacimiento);
$("#domicilio").val(domicilio);
accion=4;
});
  
$("#tbl_reg_ficha_personas tbody").on( "click", "tr", function () {
rowNumber=parseInt(table.row( this ).index());
accion=2;
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_reg_ficha_personas", function () {

$( this ).prop( "disabled", true );

identidad=$("#identidad").val();
primer_nombre=$("#primer_nombre").val();
segundo_nombre=$("#segundo_nombre").val();
primer_apellido=$("#primer_apellido").val();
segundo_apellido=$("#segundo_apellido").val();
fecha_nacimiento=$("#fecha_nacimiento").val();
sexo=$("#sexo").val();
telefono=$("#telefono").val();
id_pais_nacimiento=$("#id_pais_nacimiento").val();
domicilio=$("#domicilio").val();

 
	if(identidad== null || identidad == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para identidad',
                        type: 'error',
                        shadow: true
                    });
                $( this ).prop( "disabled", false );
                return false;
            }
	
 
	if(primer_nombre== null || primer_nombre == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Primer nombre',
                        type: 'error',
                        shadow: true
                    });
                    $( this ).prop( "disabled", false );
                return false;
            }
	
 
	/*if(segundo_nombre== null || segundo_nombre == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Segundo nombre',
                        type: 'error',
                        shadow: true
                    });
                $( this ).prop( "disabled", false );
                return false;
            }*/
	
 
	if(primer_apellido== null || primer_apellido == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Primer apellido',
                        type: 'error',
                        shadow: true
                    });
                    $( this ).prop( "disabled", false );
                return false;
            }
	
 
	/*if(segundo_apellido== null || segundo_apellido == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Segundo apellido',
                        type: 'error',
                        shadow: true
                    });
                $( this ).prop( "disabled", false );
                return false;
            }*/
	
 
	if(fecha_nacimiento== null || fecha_nacimiento == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Fecha nacimiento',
                        type: 'error',
                        shadow: true
                    });
                $( this ).prop( "disabled", false );
                return false;
            }
	
 
	if(sexo== null || sexo == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Sexo',
                        type: 'error',
                        shadow: true
                    });
                    $( this ).prop( "disabled", false );
                return false;
            }
	
 
	if(telefono== null || telefono == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Telefono',
                        type: 'error',
                        shadow: true
                    });
                $( this ).prop( "disabled", false );
                return false;
            }
	
 
	if(id_pais_nacimiento== null || id_pais_nacimiento == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Pais nacimiento',
                        type: 'error',
                        shadow: true
                    });
                    $( this ).prop( "disabled", false );
                return false;
            }
	
 
	/*if(domicilio== null || domicilio == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Domicilio',
                        type: 'error',
                        shadow: true
                    });
                $( this ).prop( "disabled", false );
                return false;
            }*/

	
preguardar_reg_ficha_personas();
});
});
$(".modal-footer").on("click", "#btn_eliminar_reg_ficha_personas", function () {
guardar_reg_ficha_personas();
});
$(".modal-footer").on("click", "#btn_activar_reg_ficha_personas", function () {
guardar_reg_ficha_personas();
});

	function preguardar_reg_ficha_personas() {
              
              var indexUploadCoincidence=0;
              
$.when(


                ).done(function (){
                  guardar_reg_ficha_personas();
                } )
                ;
              }
	
  
function guardar_reg_ficha_personas(){
$.ajax({
type: "post",
url:url_guardar_reg_ficha_personas,
data: {
 "id": id,
 "identidad": identidad,
 "primer_nombre": primer_nombre,
 "segundo_nombre": segundo_nombre,
 "primer_apellido": primer_apellido,
 "segundo_apellido": segundo_apellido,
 "fecha_nacimiento": fecha_nacimiento,
 "sexo": sexo,
 "telefono": telefono,
 "id_pais_nacimiento": id_pais_nacimiento,
 "domicilio": domicilio,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_reg_ficha_personas").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_reg_ficha_personas").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_reg_ficha_personas").modal("hide");

$( "#btn_guardar_reg_ficha_personas" ).prop( "disabled", false );

for(var i = 0; i < data.reg_ficha_personas_list.length; i++) {
var row= data.reg_ficha_personas_list[i];
var nuevaFilaDT=[
row.id,row.identidad,row.nombre_persona,row.fecha_nacimiento,row.sexo,row.telefono,row.domicilio
 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_reg_ficha_personas"'+ 
 'data-id="'+row.id+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-nombre_persona="'+row.nombre_persona+'" '+ 
 'data-fecha_nacimiento="'+row.fecha_nacimiento+'" '+ 
 'data-sexo="'+row.sexo+'" '+ 
 'data-telefono="'+row.telefono+'" '+ 
 'data-id_pais_nacimiento="'+row.id_pais_nacimiento+'" '+ 
 'data-domicilio="'+row.domicilio+'" '+ 
 'data-sexo="'+row.sexo+'" '+ 
 'data-pais_nacimiento="'+row.pais_nacimiento+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_reg_ficha_personas"'+ 
 'data-id="'+row.id+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-fecha_nacimiento="'+row.fecha_nacimiento+'" '+ 
 'data-sexo="'+row.sexo+'" '+ 
 'data-telefono="'+row.telefono+'" '+ 
 'data-id_pais_nacimiento="'+row.id_pais_nacimiento+'" '+ 
 'data-domicilio="'+row.domicilio+'" '+ 
 'data-sexo="'+row.sexo+'" '+ 
 'data-pais_nacimiento="'+row.pais_nacimiento+'" '+ 
 '><i class="fa fa-trash"></i></button>'+
''
];
if(accion==1) {
	$("#modal_reg_ficha_personas").modal("hide");
		table.row.add(nuevaFilaDT).draw();
	}else if (accion==2) {
		$("#modal_reg_ficha_personas").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}else if (accion==4) {
		$("#modal_activar_reg_ficha_personas").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}
}
 if (accion == 3){
     $("#modal_eliminar_reg_ficha_personas").modal("hide");
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
