@extends('layout.plantilla')
@section('contenido')

  <div class="alert alert-warning">
      Porfavor entre al enlace que se le envió al correo
  </div>
@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >


	</script>
@endpush