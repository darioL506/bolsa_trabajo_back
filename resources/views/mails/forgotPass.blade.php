@component('mail::message')
    Hola **{{$name}}**,  {{-- salto de linea --}}
    Usted a solicitado que le proporcionemos una nueva contraseña

    Su nueva contraseña es {{$newPass}}

    Que tenga un buen día.
@endcomponent