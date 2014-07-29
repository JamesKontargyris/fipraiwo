<!--If single message sent through...-->
@if(Session::get('message'))
    <div class="message">
        <i class="fa fa-info-circle fa-lg"></i> {{ Session::get('message') }}
    </div>
@endif
<!--If array of messages sent through...-->
@if(Session::get('messages'))
    <div class="message">
        <ul>
            @foreach(Session::get('messages') as $message)
                <li><i class="fa fa-info-circle fa-lg"></i> {{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--If errors exist...-->
@if($errors->any())
    <div class="errors">
        <ul>
            @foreach($errors->all() as $error)
                <li><i class="fa fa-warning fa-lg"></i> <strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif

