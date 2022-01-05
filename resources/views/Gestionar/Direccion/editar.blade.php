@extends('layout.plantilla')
@section('contenido')
  <div class="card">
  <div class="card-header">
    <h3 >Registrar dirección</h3>
  </div>
  <div class="card-body p-5">
  <div class="alert" id="erroresR" role="alert">
  </div>
        <form id="formularioDireccion" data-id="{{$direccion->id}}">
            @csrf
            <br>
            <div class="row">
              <div class="form-group col-3">
                <label for="exampleInputEmail1">Nombre de la direccion :</label>
                <input name="nombre" value="{{ $direccion->nombre }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <div class="form-group col">
                <label for="exampleInputPassword1">Calle :</label>
                <input name="calle" value="{{ $direccion->calle }}" type="text" class="form-control" id="exampleInputPassword1">
                <small id="emailHelp" class="form-text text-muted">Algo como : portón de madera de color rojo</small>
              </div>
            </div>
            <div class="row">
                <label for="exampleInputEmail1">Referencia :</label>
                <textarea class="form-control" name="referencia">{{ $direccion->referencia }}</textarea>
            </div>

          </form>
          <label for="">Seleccione ubicación :</label><br>
          <button id="actual" class="btn btn-success"> Ubicación actual</button>
          <button id="marcar" class=" btn btn-success"> Marcar ubicación</button>
          <br>
        <div id="map" data-latitud="{{$direccion->latitud}}"  data-longuitud="{{$direccion->longitud}}"  style="width: auto;height: 200px;"></div>
              <div class="form-group  row">
        <div class="col-4 "><a href="{{ url('/direccion/listar') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
        <div class="col-4 "> <button id="enviarDireccion" class="btn btn-outline-success w-100"> REGISTRAR</button></div>
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
          console.log(latitud);
          console.log(longuitud);
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

       $('#enviarDireccion').on('click',function(event){
       event.preventDefault();
        var data = new FormData($('#formularioDireccion')[0]);
        data.append('longuitud',longuitud);
        data.append('latitud',latitud);
        let id = document.getElementById('formularioDireccion').getAttribute('data-id');
         $.ajax({
          url:'/direccion/editar/' +id,
          method:"POST",
          data: data,
          contentType: false,
          cache:false,
          processData: false,
          dataType:"json",
          success:function(response)
          {
            if(response.success){
              window.location="http://127.0.0.1:8000/direccion/listar";
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