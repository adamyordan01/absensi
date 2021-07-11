@extends('layouts.admin', ['title', 'Absensi | Kantor Walikota-Kota Langsa'])

@section('css')
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Absensi Pulang</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if (session('success'))
                <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-primary">Absensi Pulang | Silahkan melakukan absen.</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendance-out-store') }}" method="post">
                        @csrf
                        <div class="row justify-content-center align-items-center my-3">
                            <div class="col-md-3">
                                <h2 class="text-center text-primary font-weight-bold" id="jam"></h2>
                            </div>
                            <div class="col-md-1">
                                <h2 class="text-center text-grey font-weight-bold">:</h2>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-center text-primary font-weight-bold" id="menit"></h2>
                            </div>
                            <div class="col-md-1">
                                <h2 class="text-center text-grey font-weight-bold">:</h2>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-center text-primary font-weight-bold" id="detik"></h2>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="" for="">Signature:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>

                        <div class="col-md-12">
                            <div id="my_camera"></div>
                            <br>
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type="hidden" name="image" class="image-tag">
                            <div id="results">Your captured image will appear here...</div>
                        </div>

                        <div class="row">
                            <div class="mx-auto my-5">
                                <button type="submit" class="btn btn-lg btn-primary text-center">Klik Absensi Pulang</button>
                            </div>
                        </div>
                    </form>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
	window.setTimeout("waktu()", 1000);
 
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
<script>
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'png',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
@endsection