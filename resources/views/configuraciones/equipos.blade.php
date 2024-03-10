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
                 <h1>Equipos</h1>
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
              <table class="jambo_table table table-hover" id="tbl_equipos" border=1>
                 <thead >
                    <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                       <th scope="col">id</th>
                       <th scope="col">Equipo</th>
                       <th scope="col">Descripcion</th>
                       <th scope="col">Opciones</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach ($equipos_list as $row)
                    <tr style="font-size: medium">
                       <td scope="row">{{$row->id}}</td>
                       <td scope="row">{{$row->nombre}}</td>
                       <td scope="row">{{$row->descripcion}}</td>
                       <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#modal_equipos"
                             data-id="{{$row->id}}"
                             data-nombre="{{$row->nombre}}"
                             data-descripcion="{{$row->descripcion}}"
                             ><i class="fa fa-edit"></i></button>
                          &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_equipos"
                             data-id="{{$row->id}}"
                             data-nombre="{{$row->nombre}}"
                             data-descripcion="{{$row->descripcion}}"
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
<div id="modal_equipos" class="modal fade"  role="dialog" aria-labelledby="modal_equipos" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">Equipos</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
           <form id="antoform2" class="form-horizontal calender" role="form">
              <div class="form-group">
                 <label class="">Equipo</label>		
                 <input type="text" class="form-control" id="nombre" name="nombre">
              </div>
              <div class="form-group">
                 <label class="">Descripcion</label>		
                 <input type="text" class="form-control" id="descripcion" name="descripcion">
              </div>
           </form>
        </div>
        <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button> 
           <button type="button" id="btn_guardar_equipos" class="btn btn-primary antosubmit2">Guardar</button>
        </div>
     </div>
     <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->  
<div id="modal_eliminar_equipos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_equipos aria-hidden="true">
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
           <button type="button" id="btn_eliminar_equipos" class="btn btn-danger antosubmit2">Eliminar</button>
        </div>
     </div>
     <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="modal_eliminar_equipos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_equipos aria-hidden="true">
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
           <button type="button" id="btn_activar_equipos" class="btn btn-primary antosubmit2">Activar</button>
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
var nombre=null;
var descripcion=null;
var url_guardar_equipos= "{{url('/configuracion/equipos')}}/guardar";
var table=null;
var rowNumber=null;
$(document).ready(function () {
 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});	
table=$("#tbl_equipos" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [
	{
		text: "<i class='fas fa-plus'></i> Agregar",
	    className: 'btn btn-block btn-default',  
		action: function ( e, dt, node, config ) {
			accion=1;
			$("#modal_equipos").modal("show");
		}
	}
]
});
 

	
$("#modal_equipos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
nombre=triggerLink.data("nombre");
descripcion=triggerLink.data("descripcion");
$("#id").val(id);
$("#nombre").val(nombre);
$("#descripcion").val(descripcion);
});
  
$("#modal_eliminar_equipos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
nombre=triggerLink.data("nombre");
descripcion=triggerLink.data("descripcion");
$("#id").val(id);
$("#nombre").val(nombre);
$("#descripcion").val(descripcion);
accion=3;
});
  
$("#modal_activar_equipos").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
nombre=triggerLink.data("nombre");
descripcion=triggerLink.data("descripcion");
$("#id").val(id);
$("#nombre").val(nombre);
$("#descripcion").val(descripcion);
accion=4;
});
  
$("#tbl_equipos tbody").on( "click", "tr", function () {
rowNumber=parseInt(table.row( this ).index());
accion=2;
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_equipos", function () {
nombre=$("#nombre").val();
descripcion=$("#descripcion").val();
 
	if(nombre== null || nombre == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Equipo',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
	
 
	/*if(descripcion== null || descripcion == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Descripcion',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }*/
	
preguardar_equipos();
});
});
$(".modal-footer").on("click", "#btn_eliminar_equipos", function () {
guardar_equipos();
});
$(".modal-footer").on("click", "#btn_activar_equipos", function () {
guardar_equipos();
});

	function preguardar_equipos() {
              
              var indexUploadCoincidence=0;
              
$.when(


                ).done(function (){
                  guardar_equipos();
                } )
                ;
              }
	
  
function guardar_equipos(){
$.ajax({
type: "post",
url:url_guardar_equipos,
data: {
 "id": id,
 "nombre": nombre,
 "descripcion": descripcion,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_equipos").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_equipos").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_equipos").modal("hide");
for(var i = 0; i < data.equipos_list.length; i++) {
var row= data.equipos_list[i];
var nuevaFilaDT=[
row.id,row.nombre,row.descripcion
 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_equipos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-nombre="'+row.nombre+'" '+ 
 'data-descripcion="'+row.descripcion+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_equipos"'+ 
 'data-id="'+row.id+'" '+ 
 'data-nombre="'+row.nombre+'" '+ 
 'data-descripcion="'+row.descripcion+'" '+ 
 '><i class="fa fa-trash"></i></button>'+  
''
];
if(accion==1) {
	$("#modal_equipos").modal("hide");
		table.row.add(nuevaFilaDT).draw();
	}else if (accion==2) {
		$("#modal_equipos").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}else if (accion==4) {
		$("#modal_activar_equipos").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}
}
 if (accion == 3){
     $("#modal_eliminar_equipos").modal("hide");
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
