<h1>{{ $details['subject'] }}</h1>
<p>{{ $details['message'] }}</p>
@if(isset($details['appointment']))
    <ul>
        <li><strong>Nombre:</strong> {{ $details['appointment']['name'] }}</li>
        <li><strong>Fecha:</strong> {{ $details['appointment']['date'] }}</li>
        <li><strong>Hora:</strong> {{ $details['appointment']['time'] }}</li>
    </ul>
@endif
