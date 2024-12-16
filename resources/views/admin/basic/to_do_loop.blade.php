@foreach ($to_do_list as $to_do)
<tr>
    <td>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" value="{{ $to_do->id }}" class="custom-control-input to-do-input" id="to_do_{{ $to_do->id }}" {{ $to_do->status == true ? 'checked' : '' }} />
            <label class="custom-control-label todo-title" for="to_do_{{ $to_do->id }}">{{ $to_do->title ?? '' }}</label>
        </div>
    </td>
    <td>{{ date('d M, Y',strtotime($to_do->to_do_date)) }}</td>
    <td>
        <span class="badge badge-pill badge-light-primary">{{ $to_do->priority }}</span>
    </td>
    {{-- <td>
        <span class="badge badge-pill badge-light-{{ 
            $to_do->status == 'Pending' ? 'warning' : 
            ($to_do->status == 'In-progress' ? 'primary' : 'success') 
        }}">
            {{ $to_do->status }}
        </span>
    </td> --}}
    <td>
        <a href="" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>
        <a href="" class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
@endforeach

<script>
    $('.to-do-input').click(function () {
        const checkboxValue = $(this).val();
        const isChecked = $(this).is(':checked');
        const status = "";
        axios.get('')
        loadToDo();
    });
</script>


