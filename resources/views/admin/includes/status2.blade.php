@if(Session::has('message'))
    <div style="color: red"><i class="icon-trash icon-large"></i>
        {{ Session::get('message') }}
    </div>
@endif