<!DOCTYPE html>
<html lang="en">

<head>
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" media="print">
    --}}
    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        /* Striped Table */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <main>
        <div class="text-center">
            <p>{{ siteSetting()['company_name'] ?? "" }}</p>
        </div>
        <h4 class="text-center"><u>Expense Reports</u></h4>

        <table class="table table-striped table-bordered">
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
        <h4 class="left"><u>Expenses</u></h4>
        <table class="table table-sm table-bordered">
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
                    <td>{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                    <td>{{ $data->work_order->name ?? 'N/A' }}</td>
                    <td>{{ $data->payment_method ?? 'N/A' }}</td>
                    <td>{{ $data->note ?? 'N/A' }}</td>
                    <td>{{ $data->amount ?? 'N/A' }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="b-white" colspan="7"></td>
                    <td class="unit text-left"><b>Total:</b></td>
                    <td class="unit text-left text-nowrap">{{ $total_expense ?? 0 }} {{ "BDT" }}</td>
                </tr>
            </tbody>
        </table>
    </main>

</body>

</html>