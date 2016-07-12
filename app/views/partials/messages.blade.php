@if(Session::get('message'))
    <div class="message">
        {{ Session::get('message') }}
    </div>
@endif

@if(Session::get('error'))
    <div class="error">
        {{ Session::get('error') }}
    </div>
@endif