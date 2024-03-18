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

            <video id="video-id" width="100%" height="100%" controls><source src="https://dacastmmd.mmdlive.lldns.net/dacastmmd/ee5718fe8b65478c8acebf83cfa4ae53/manifest.m3u8?p=79&h=05acbf293dcb8e5c08d76762cff47058" type="application/x-mpegURL" />


             

                
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
 


@endsection
@section("scripts")

<!--<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>-->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_LIVE_CLIENT_ID') }}"></script>

{{-- <script id="c1c8c921-b706-cba9-d464-94e95a1444ca-live-4e402dad-0c1c-7ae5-4589-0c6daf44249f" width="100%" height="100%" src="https://player.dacast.com/js/player.js?contentId=c1c8c921-b706-cba9-d464-94e95a1444ca-live-4e402dad-0c1c-7ae5-4589-0c6daf44249f" class="dacast-video"></script> --}}

<script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>


<script type="text/javascript">
  
  var myFP = fluidPlayer(
        'video-id',	{
	"layoutControls": {
		"controlBar": {
			"autoHideTimeout": 3,
			"animated": true,
			"autoHide": true
		},
		"htmlOnPauseBlock": {
			"html": null,
			"height": null,
			"width": null
		},
		"autoPlay": true,
		"mute": true,
		"allowTheatre": true,
		"playPauseAnimation": false,
		"playbackRateEnabled": false,
		"allowDownload": false,
		"playButtonShowing": false,
		"fillToContainer": false,
		"posterImage": ""
	},
	"vastOptions": {
		"adList": [],
		"adCTAText": false,
		"adCTATextPosition": ""
	}
});

</script>
@endsection
