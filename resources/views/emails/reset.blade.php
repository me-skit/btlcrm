@component('mail::message')

# ¡Hola!

Ha recibido este correo porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.

@component('mail::button', ['url' => $url])
Restablecer Contraseña
@endcomponent

Este link de restablecimiento expira en 60 minutos.

Si no solicito restablecer su contraseña, no es necesario realizar ninguna acción.

Saludos,<br>
{{ config('app.name') }}

@component('mail::subcopy')
Si tiene problemas con el botón "Restablecer Contraseña", utilice el siguiente enlace: <{{ $url }}>
@endcomponent

@endcomponent
