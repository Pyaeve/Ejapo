<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $name }}!, gracias por confirmar tu registro a <strong>Pya'eve.com</strong> !</h2>
    <p>Estos son tus datos para usar la Aplicaci&oacutel;n</p>
    <br>
   <p><b>Link:</b> <a href="https://ejapo.pyaeve.com">Acceder a Pya'eve.com</a></p>
    <p><b>Usuario:</b> {{ $email }} *</p>
     <p><b>Contrase&ntilde;a:</b>{{$password_text}} *</p>

   <br>
   <p>*No compartas estos datos</p>
   <br>
   <p>Atte.</p>
   <p><b>El Equipo de <a href="https://pyaeve.com">Pyaeve.com</a></b></p>
</body>
</html>