<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2 style="color: blue;font-size: 20px;">Hola , {{$nombreCliente}} <strong>gracias por registarte!!</strong></h2>
    <p>Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

    <a href="{{url('cliente/verificacion/'.$token)}}">
        Clic para confirmar tu email
    </a>
</body>
</html>