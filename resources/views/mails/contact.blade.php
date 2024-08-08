@component('mail::message')
# Haz recibido un correo del sitio Adela de Cornejo
{{$data['name']}} te ha enviado un mensaje desde la web de Adela de cornejo
<br>
Correo de contacto: {{$data['email']}}
@component('mail::panel')
{{$data['message']}}
@endcomponent

@endcomponent
