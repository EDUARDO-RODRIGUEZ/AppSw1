@extends('layout.plantilla')
@section('contenido')

	<div class="card p-3">

<ul class="nav nav-pills row mb-3" id="pills-tab" role="tablist">
  <li class="nav-item col" role="presentation">
    <a class="nav-link disabled " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Productos a confirmar</a>
  </li>
  <li class="nav-item col" role="presentation">
    <a class="nav-link disabled" id="pills-profile-tab"  data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Formulario de dirección</a>
  </li>
  <li class="nav-item col" role="presentation">
    <a class="nav-link active " id="pills-contact-tab"  data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Terminos y condiciones</a>
  </li>
</ul>


<div class="tab-content bg-white" id="pills-tabContent">
  <div class="tab-pane " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">



  </div>
    <div class="tab-pane bg-white fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="row">
        <div class="col border p-3">
          <h3 class="text"> Aceptar terminos y condiciones</h3>
          <form action="{{ url('/realizarPedido/finalizarPedido') }}" method="POST">
            @csrf
            <br>

            <br>

            <br>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Terminos y condiciones</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="7">Al acceder a este sitio web, asumimos que aceptas estos términos y condiciones en su totalidad. No continúes usando el sitio web (Nombre de la tienda) si no aceptas todos los términos y condiciones establecidos en esta página.

La siguiente terminología se aplica a estos Términos y Condiciones, Declaración de Privacidad y Aviso legal y cualquiera o todos los Acuerdos: el Cliente, Usted y Su se refieren a usted, la persona que accede a este sitio web y acepta los términos y condiciones de la Compañía. La Compañía, Nosotros mismos, Nosotros y Nuestro, se refiere a nuestra Compañía. Parte, Partes o Nosotros, se refiere en conjunto al Cliente y a nosotros mismos, o al Cliente o a nosotros mismos.

Todos los términos se refieren a la oferta, aceptación y consideración del pago necesario para efectuar el proceso de nuestra asistencia al Cliente de la manera más adecuada, ya sea mediante reuniones formales de una duración fija, o por cualquier otro medio, con el propósito expreso de conocer las necesidades del Cliente con respecto a la provisión de los servicios/productos declarados de la Compañía, de acuerdo con y sujeto a la ley vigente de (Dirección).

Cualquier uso de la terminología anterior u otras palabras en singular, plural, mayúsculas y/o, él/ella o ellos, se consideran intercambiables y, por lo tanto, se refieren a lo mismo.

Cookies

Empleamos el uso de cookies. Al utilizar el sitio web de (Nombre de la tienda), usted acepta el uso de cookies de acuerdo con la política de privacidad de (Nombre de la tienda). La mayoría de los modernos sitios web interactivos de hoy en día usan cookies para permitirnos recuperar los detalles del usuario para cada visita.

Las cookies se utilizan en algunas áreas de nuestro sitio para habilitar la funcionalidad de esta área y la facilidad de uso para las personas que lo visitan. Algunos de nuestros socios afiliados/publicitarios también pueden usar cookies.

Licencia

A menos que se indique lo contrario, (Nombre de la tienda) y/o sus licenciatarios les pertenecen los derechos de propiedad intelectual de todo el material en (Nombre de la tienda).

Todos los derechos de propiedad intelectual están reservados. Puedes ver y/o imprimir páginas desde (Agrega URL) para tu uso personal sujeto a las restricciones establecidas en estos términos y condiciones.

No debes:

Volver a publicar material desde (Añadir URL).
Vender, alquilar u otorgar una sub-licencia de material desde (Agregar URL).
Reproducir, duplicar o copiar material desde (Agregar URL).
Redistribuir contenido de (Nombre de la tienda), a menos de que el contenido se haga específicamente para la redistribución.
Aviso legal

En la medida máxima permitida por la ley aplicable, excluimos todas las representaciones, garantías y condiciones relacionadas con nuestro sitio web y el uso de este sitio web (incluyendo, sin limitación, cualquier garantía implícita por la ley con respecto a la calidad satisfactoria, idoneidad para el propósito y/o el uso de cuidado y habilidad razonables).

Nada en este aviso legal:

Limita o excluye nuestra o su responsabilidad por muerte o lesiones personales resultantes de negligencia.
Limita o excluye nuestra o su responsabilidad por fraude o tergiversación fraudulenta.
Limita cualquiera de nuestras o sus responsabilidades de cualquier manera que no esté permitida por la ley aplicable.
Excluye cualquiera de nuestras o sus responsabilidades que no pueden ser excluidas bajo la ley aplicable.
Las limitaciones y exclusiones de responsabilidad establecidas en esta Sección y en otras partes de este aviso legal:
1. están sujetas al párrafo anterior; y
2. rigen todas las responsabilidades que surjan bajo la exención de responsabilidad o en relación con el objeto de esta exención de responsabilidad, incluidas las responsabilidades que surjan en contrato, agravio (incluyendo negligencia) y por incumplimiento del deber legal.

En la medida en que el sitio web y la información y los servicios en el sitio web se proporcionen de forma gratuita, no seremos responsables de ninguna pérdida o daño de ningún tipo.

Esta página de Términos y Condiciones fue creada como un ejemplo por Jumpseller.</textarea>
            </div>
            <br>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Acepto terminos y condiciones
              </label>
            </div>
            <br>
            <button href="" type="submit" id="finalizar" class="btn btn-success"> FINALIZAR COMPRA</button>
          </form>
          <br>
          <div class="row">
            <div class="col">
              <a href="{{url('realizarPedido/formularioDireccion')}}" class="btn btn-danger my-3  w-100">ANTERIOR</a>
            </div>
            <div class="col">
              <a href="{{url('realizarPedido/carrito')}}" class="btn btn-info my-3  w-100">VOLVER A CARRITO</a>
            </div>
          </div>
        </div>
        <div class="col-4 m-2">
          <div class="card">
            <div class="card-header">
              <h5 class=" text-success text-center">Detalle de compra</h5>
            </div>
            <div class="card-body">
                            <h4 class=" text-success">Empresa :<span class="badge badge-success">@if(!empty($total)){{ $empresa}}<span>@else Ninguna @endif</h4>

              <h3 class=" text-success">Total : <span class="badge badge-success">@if(!empty($total)){{$total}}@else 0 @endif</span> </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>


	</div>


@endsection
@push('scripts')
<script type="text/javascript">
        window.addEventListener("load", function(){
        let botonFinalizar = document.getElementById('finalizar');
        botonFinalizar.disabled=true;
        });
$('input[type="checkbox"]').on('change', function(e){
    if (this.checked) {
        let botonFinalizar = document.getElementById('finalizar');
        botonFinalizar.disabled=false;
    } else {
        let botonFinalizar = document.getElementById('finalizar');
        botonFinalizar.disabled=true;
    }
});
</script>
@endpush