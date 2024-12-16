@if(Session::has('message'))
    <x-alert-message-component
        type="{{ Session::get('type') }}"
        message="{{ Session::get('message') }}">
    </x-alert-message-component>
@endif
