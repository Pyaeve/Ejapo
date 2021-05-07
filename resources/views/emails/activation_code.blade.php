<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $name }}!, gracias por registrarte a <strong><a href="{{ url('/e/v/' . $activation_code) }}">
        Pya'eve.com
    </a></strong> !</h2>
    <p>Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

    <a href="{{ url('/e/v/' . $activation_code) }}">
        Click para confirmar tu email
    </a>
</body>
</html>