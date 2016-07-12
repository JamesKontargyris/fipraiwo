@if($errors->all())
    <div class="errors">
        {{--<i class="fa fa-warning fa-lg"></i> <strong>Please address the following errors:</strong>--}}

        <ul>
            @foreach($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif