@extends('layout.plantilla')
@section('contenido')
<div class="card p-3">
    <ul class="nav nav-pills row mb-3" id="pills-tab" role="tablist">
        <li class="nav-item col" role="presentation">
            <a aria-controls="pills-home" aria-selected="false" class="nav-link disabled " data-toggle="pill" href="#pills-home" id="pills-home-tab" role="tab">
                Productos a confirmar
            </a>
        </li>
        <li class="nav-item col" role="presentation">
            <a aria-controls="pills-profile" aria-selected="true" class="nav-link active" data-toggle="pill" href="#pills-profile" id="pills-profile-tab" role="tab">
                Formulario de dirección
            </a>
        </li>
        <li class="nav-item col" role="presentation">
            <a aria-controls="pills-contact" aria-selected="false" class="nav-link disabled" data-toggle="pill" href="#pills-contact" id="pills-contact-tab" role="tab">
                Aceptar terminos y condiciones
            </a>
        </li>
    </ul>
    <div class="tab-content bg-white" id="pills-tabContent">
        <div aria-labelledby="pills-home-tab" class="tab-pane " id="pills-home" role="tabpanel">
        </div>
        <div aria-labelledby="pills-profile-tab" class="tab-pane bg-white fade show active" id="pills-profile" role="tabpanel">
            <div class="row">
                <div class="col border p-3">
                    <h3 class="text">
                        Introduzca los datos de su ubicacion
                    </h3>
                    <div class="alert" id="erroresR" role="alert">
                    </div>
                    <label>
                        ¿ Tienes guardado tus datos de dirección ?
                    </label>
                    <a class="btn btn-primary btn-sm" href="{{ url('/asignarDireccion/listar') }}">
                        Elegir
                    </a>
                    <form id="formularioDireccion">
                        @csrf
                        <br>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="exampleInputEmail1">
                                        Calle :
                                    </label>
                                    <input @if(!empty($calle[0])) value="{{$calle[0] }}" @endif aria-describedby="emailHelp" class="form-control" id="exampleInputEmail1" name="calle" type="email" >
                                    </input>
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">
                                        Referencia :
                                    </label>
                                    <input @if(!empty($referencia[0])) value="{{$referencia[0] }}" @endif class="form-control" id="exampleInputPassword1" name="referencia" type="text" >
                                        <small class="form-text text-muted" id="emailHelp">
                                            Algo como : portón de madera de color rojo
                                        </small>
                                    </input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="exampleInputEmail1">
                                        Detalle del pedido :
                                    </label>
                                    <input @if(!empty($detalle)) value="{{$detalle }}"  @endif  aria-describedby="emailHelp" class="form-control" id="exampleInputEmail1" name="detalle" type="email" >
                                    </input>
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">
                                        Razon social :
                                    </label>
                                    <input @if(!empty($razonsocial))  value="{{$razonsocial }}"  @endif class="form-control" id="exampleInputPassword1" name="razonsocial" type="text">
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Nit :
                                </label>
                                <input @if(!empty($nit)) value="{{$nit }}" @endif  class="form-control" id="exampleInputPassword1" name="nit" type="text" >
                                </input>
                            </div>
                        </br>
                    </form>
                    <label for="">
                        Seleccione ubicación :
                    </label>
                    <br>
                        <button class="btn btn-success" id="actual">
                            Ubicación actual
                        </button>
                        <button class=" btn btn-success" id="marcar">
                            Marcar ubicación
                        </button>
                        <br>
                            <div  @if(!empty($latitud[0])) data-latitud="{{$latitud[0] }}" @endif @if(!empty($longuitud[0]))  data-longuitud="{{$longuitud[0] }}" @endif id="map" style="width: auto;height: 200px;">
                            </div>
                            <a class="btn btn-danger my-3 w-50" href="{{url('realizarPedido/carrito')}}">
                                ANTERIOR
                            </a>
                        </br>
                    </br>
                </div>
                <div class="col-4 m-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class=" text-success text-center">
                                Detalle de compra
                            </h5>
                        </div>
                        <div class="card-body">
                            <h4 class=" text-success">
                                Empresa :
                                <span class="badge badge-success">
                                    @if(!empty($empresa)){{ $empresa}}
                                    <span>
                                        @else Ninguna @endif
                                    </span>
                                </span>
                            </h4>
                            <h3 class=" text-success">
                                Total :
                                <span class="badge badge-success">
                                    @if(!empty($total)){{$total}}@else 0 @endif
                                </span>
                            </h3>
                        </div>
                        <button class="btn btn-success enviarDireccion">
                            SIGUIENTE
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-labelledby="pills-contact-tab" class="tab-pane fade" id="pills-contact" role="tabpanel">
            ...
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    let map;
let markers = [];
var latitud = document.getElementById('map').getAttribute('data-latitud');
var longuitud = document.getElementById('map').getAttribute('data-longuitud') ;
var actualL= document.getElementById('actual');
var  marcarL= document.getElementById('marcar');

      window.addEventListener("load", function(){
        if(latitud!=null && longuitud !=null){
          latitud= String(latitud);
          longuitud= String(longuitud);
          console.log(latitud)
          console.log(longuitud)
        let pos = new google.maps.LatLng(latitud,longuitud);

              map = new google.maps.Map(document.getElementById('map'), {
              center: pos,
                  zoom: 13,
                  mapTypeId: 'roadmap'
                });

                var marker = new google.maps.Marker({
                  position:pos,
                  map: map,
            title: 'Acuario de Gijón'
                });
        }
      });
      actualL.addEventListener('click',function(){
            const haightAshbury = { lat: 37.769, lng: -122.446 };
            map = new google.maps.Map(document.getElementById("map"), {
              zoom: 15,
              center: haightAshbury,
              mapTypeId: "terrain"
            });
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
              };
              latitud= pos.lat;
              longuitud= pos.lng;
              addMarker(pos);
              map.setCenter(pos);
              }, function() {
              //handleLocationError(true, infoWindow, map.getCenter());
              });
            } else {
            // Browser doesn't support Geolocation
              //handleLocationError(false, infoWindow, map.getCenter());
            }
            // This event listener will call addMarker() when the map is clicked.

              // Adds a marker at the center of the map.
              addMarker(haightAshbury);
      });

      marcarL.addEventListener('click',function(){
            const haightAshbury = { lat: 37.769, lng: -122.446 };
            map = new google.maps.Map(document.getElementById("map"), {
              zoom: 15,
              center: haightAshbury,
              mapTypeId: "terrain"
            });
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
              };
              addMarker(pos);
              map.setCenter(pos);
              latitud= pos.lat;
              longuitud= pos.lng;
                            console.log(latitud +' y' +longuitud);
              }, function() {
              //handleLocationError(true, infoWindow, map.getCenter());
              });
            } else {
            // Browser doesn't support Geolocation
              //handleLocationError(false, infoWindow, map.getCenter());
            }
            // This event listener will call addMarker() when the map is clicked.
              map.addListener("click", event => {
              deleteMarkers();
              addMarker(event.latLng);
              latitud= event.latLng.lat();
              longuitud= event.latLng.lng();
                            console.log(latitud +' y' +longuitud);
              });
              // Adds a marker at the center of the map.
              addMarker(haightAshbury);
      });

      // Adds a marker to the map and push to the array.
      function addMarker(location) {
        const marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);
      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }



      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });

       $('.enviarDireccion').on('click',function(event){
       event.preventDefault();
        var data = new FormData($('#formularioDireccion')[0]);
        data.append('longuitud',longuitud);
        data.append('latitud',latitud);
         $.ajax({
          url:"formularioMetodoPago",
          method:"POST",
          data: data,
          contentType: false,
          cache:false,
          processData: false,
          dataType:"json",
          success:function(response)
          {
            if(response.success){
              window.location=`{{ url('realizarPedido/MetodoPago') }}`;
            }else {
              html = '<ul class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Mensaje informativo : <br>';
              for(var count = 0; count < response.errors.length; count++)
              {
              html += '<li class="mx-4 text-sm">' + response.errors[count] + '</li>';
              }
              html += '</ul>';
              $('#erroresR').html(html);
            }
          }
         });
        });
</script>
@endpush
