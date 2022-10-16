@component('mail::message')

Es un gusto comunicarle que se a activado una cuenta con su correo electronico.

Su contraseña es: {{ $pass }}

Si tiene dudas o comentarios, favor de contactar a un administrador<br>
(Si este correo fue enviado por error, favor de ignorarlo).

Nuestros mejores deseos,<br>
{{ config('app.name') }}
@endcomponent
