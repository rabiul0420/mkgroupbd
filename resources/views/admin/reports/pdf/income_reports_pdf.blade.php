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
<h4 class="text-center text-underline">Income Reports</h4>

<table class="table table-sm full-border table-bordered" >
    <thead>
        <tr>
            <th>Income Sector</th>
            <th>By</th>
            <th>Date</th>
            <th>Work Order</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $search_sector ?
                App\Models\IncomeSector::find($search_sector)->name : "All" }}</td>
            <td>{{ isset($received_by) ?
                userNameById($received_by) : 'All' }}</td>
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

<h5 class="text-center text-underline mt-2">Incomes</h5>

<table class="table table-sm table-bordered text-left">
    <thead>
        <tr>
            <th>SL</th>
            <th>Title</th>
            <th>Income Sector</th>
            <th>Work Order</th>
            <th>Received Date</th>
            <th>Received By</th>
            <th>Income Amount</th>
            <th>Vat</th>
            <th>Tax</th>
            <th>Net Income</th>
            <th>Payment Method</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ strLimit($data->title,100) ?? 'N/A' }}</td>
            <td>{{ $data->income_sector->name ?? 'N/A' }}</td>
            <td>{{ $data->work_order->name ?? 'N/A' }}</td>
            <td>{{ date('d M, y',strtotime($data->receive_date)) ?? 'N/A' }}</td>
            <td>{{ $data->user->name ?? 'N/A' }}</td>
            <td>{{ $data->amount ?? 'N/A' }}</td>
            <td>{{ $data->vat ?? 'N/A' }}</td>
            <td>{{ $data->tax ?? 'N/A' }}</td>
            <td>{{ $data->net_income ?? 'N/A' }}</td>
            <td>{{ $data->payment_method ?? 'N/A' }}</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
        </tr>
        @endforeach
        
        <tr>
            <td class="unit text-left" colspan="11"><b>Total:</b></td>
            <td class="unit text-left text-nowrap">{{ $total_income ?? 0 }} {{ "BDT" }}</td>
        </tr>
    </tbody>
</table>

<p class="mt-2">Generated On : {{ $generated_on }}</p>

@endsection