@if(count($results))
@if(count($results))
@foreach($results as $value)
<div class="card {{ $loop->index > 0 ? 'mt-2' : '' }}">
    <div class="card-header p-1 {{ $value->status == 'Pending' ? 'bg-danger' : ($value->status == " In-Progress"
        ? 'bg-warning' : 'bg-info' ) }}">
        <h6 class="pull-left">
            {{ $value->title ?? "N/A" }}
            <pre></pre>
            <span class="badge-glow badge-primary p-0 card-header-user">{{ $value->user->name ?? "N/A" }}</span>
        </h6>
        <h6 class="pull-right">
            {{-- <span class="badge badge-info">{{ $value->status }}</span>
            <pre></pre> --}}
            <a href="javascript:void(0)" class="badge badge-success ">
                Make Done
            </a>
        </h6>
    </div>
    <div class="card-body mt-2">
        {{-- @if($value->ticket_id != Null)
        <h6>@lang('index.ticket') : {{ $value->ticket->ticket_no.' - '. $value->ticket->title ?? "" }} </h6>
        @endif --}}

        <p class="text-justify">{!! $value['description'] ?? "N/A" !!}</p>
    </div>
</div>
@endforeach
@else
<p class="alert alert-danger">No Data Found!</p>
@endif

@else
<p class="alert alert-danger">No Data Found!</p>
@endif