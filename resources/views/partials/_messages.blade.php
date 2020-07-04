@if (Session::has('success'))

    <div class="alert alert-success" role="alert" style="margin: 10px 20px 20px 20px; padding-left: 50px; padding-right: 30px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success: </strong> {{ Session::get('success') }}
    </div>

@endif

@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert" style="margin: 10px 20px 20px 20px; padding-left: 50px; padding-right: 30px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Errors: </strong> {{ Session::get('fail') }}
        <ul style="list-style: none">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
