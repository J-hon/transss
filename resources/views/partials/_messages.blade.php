@if (Session::has('message'))

    <div class="alert alert-info" role="alert" style="margin: 10px 20px 20px 20px; padding-left: 50px; padding-right: 30px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Message: </strong> {{ Session::get('message') }}
    </div>

@endif
