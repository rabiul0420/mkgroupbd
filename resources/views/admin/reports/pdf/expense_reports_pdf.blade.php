@extends('admin.reports.layouts')
@push('css')
<style>
    body {
        /* font-family: 'bangla', Times New Roman; */
    }
    .logo {
        vertical-align: top;
        height: 150px;
        width: 150px;
    }
 
</style>

@endpush
@section('content')
<h4 class="text-center text-primary">{{ siteSetting()['company_name'] }}</h4>
<hr>
<h4 class="text-center text-underline">Expense Reports</h4>

<table class="table table-sm full-border table-bordered" >
    <thead>
        <tr>
            <th>Category</th>
            <th>By</th>
            <th>Date</th>
            <th>Work Order</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $search_category ?
                App\Models\ExpenseCategory::find($search_category)->name : "All" }}</td>
            <td>{{ isset($responsible_person) ?
                userNameById($responsible_person) : 'All' }}</td>
            <td>
                @if(isset($from_date) && !isset($to_date))
                {{ date('d M, y',strtotime($from_date)) }}
                @elseif(isset($to_date) && !isset($from_date))
                {{ date('d M, y',strtotime($to_date)) }}
                @elseif(isset($from_date) && isset($to_date))
                {{ date('d M, y',strtotime($from_date)) . ' - '.date('d M, y',strtotime($to_date)) }}
                @else
                {{ "N/A" }}
                @endif

            </td>
            <td>{{ $work_order ? App\Models\WorkOrder::find($work_order)->title
                : "N/A" }}</td>
            <td>{{ $payment_method ?? "All" }}</td>
        </tr>

    </tbody>
</table>

<h5 class="text-center text-underline mt-2">Expenses</h5>

<table class="table table-sm table-bordered text-left">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Title</th>
            <th>Category</th>
            <th>Expense Date</th>
            <th>Responsible Person</th>
            <th>Work Order</th>
            <th>Payment Method</th>
            <th>Note</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$data->title ?? 'N/A' }}</td>
            <td>{{ $data->category->name ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
            <td class="text-nowrap">{{ $data->amount ?? 'N/A' }}</td>
        </tr>
        @endforeach
        <tr>
            <td class="text-center" colspan="8"><b>Total:</b></td>
            <td class="text-left text-nowrap">{{ $total_expense ?? 0 }} {{ "BDT" }}</td>
        </tr>
    </tbody>
</table>

<p class="mt-2">Generated On : {{ $generated_on }}</p>

@endsection