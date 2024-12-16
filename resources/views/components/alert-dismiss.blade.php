<div>
    @if(Session::has('message'))
        <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
            <strong>{{ $message ?? "Message" }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
</div>
