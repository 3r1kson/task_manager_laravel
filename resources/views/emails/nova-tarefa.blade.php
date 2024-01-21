@component('mail::message')
# {{ $tarefa }}

Data limite de conclusao: {{ $data_tarefa_conclusao }}
@component('mail::button', ['url' => $url])
Clique aqui para ver a tarefa
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
