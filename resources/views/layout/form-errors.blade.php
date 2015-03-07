@if(count($errors) > 0)
    <div>
        @lang('auth.input-errors')<br />
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
