<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ 'Invoice Details' }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pdf_css/invoice_pdf.css') }}">
    <link href="https://fonts.cdnfonts.com/css/serif" rel="stylesheet">

    <style>
        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin-top: 100px;
        }

        header {
            width: 90%;
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }


        .unit {
            border: 2px solid white;
            background: #6FA8DC;
            font-weight: bold;
            color: black;
        }

        .desc {
            background: whitesmoke;
            border: 2px solid white;
            color: black;
            font-weight: 600;
        }

        .b-white {
            border: 1px solid white;
        }

        .align-baseline {
            vertical-align: baseline;
        }

        p {
            color: black;
            font-weight: 400;
        }

        @media print {
            .unit {
                background: #0F75BC !important;
                color: whitesmoke;
                -webkit-print-color-adjust: exact;
            }

            .desc {
                background: whitesmoke !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body>

    <table style="border-bottom: 2px solid #0F75BC">
        <tr>
            <th style="text-align: left;border: 1px solid white;">
                <img src="{{ asset('assets/common/images/logo.png') }}" height="105" width="100" />
            </th>
            <th style="text-align: right;border: 1px solid white;verti">
                <h2>{{ siteSetting()['company_name'] ?? '' }}</h2>
                <p>{{ siteSetting()['address'] ?? '' }}</p>
                <p>{{ siteSetting()['email'] ?? '' }}</p>
                <p>{{ siteSetting()['phone'] ?? (siteSetting()['mobile'] ?? '') }}</p>
            </th>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <h4>Invoice No : {{ $invoice->invoice_no }}</h4>
            </td>
            <td class="text-right">
                <h5>Invoice Date : {{ date('d M, y', strtotime($invoice->invoice_date)) ?? '' }}</h5>
            </td>
        </tr>
    </table>
    <h2 class="text-bold text-black">Product/Items</h2>
    <hr>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th class="unit text-left">Sn</th>
                <th class="unit text-left">Product/Item</th>
                <th class="unit text-left">Unit Price</th>
                <th class="unit text-center">Quantity</th>
                <th class="unit text-center">Total Price</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($invoice->invoice_data as $inv_data)
                <tr>
                    <td class="desc text-left">{{ $loop->index + 1 }}</td>
                    <td class="desc text-left">
                        {{ $inv_data->product->name ?? '' }}
                        @if ($inv_data->item_details !== null)
                            <br>
                            <small>{{ $inv_data->item_details ?? '' }}</small>
                        @endif
                    </td>
                    <td class="desc text-center">{{ $inv_data->unit_price ?? '' }}</td>
                    <td class="desc text-center">{{ $inv_data->quantity ?? '' }}</td>
                    <td class="desc text-right">{{ $inv_data->total_price ?? '' }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="b-white" colspan="3"></td>
                <td class="desc text-left"><b>Sub Total:</b></td>
                <td class="desc text-right"><b>{{ $invoice->sub_total ?? 0 }}</b> </td>
            </tr>

            <tr>
                <td class="b-white" colspan="3"></td>
                <td class="desc text-left"><b>Tax</b></td>
                <td class="desc text-right"><b>{{ $invoice->tax ?? 0 }}</b> </td>
            </tr>
            <tr>
                <td class="b-white" colspan="3"></td>
                <td class="unit text-left"> <b>Grand Total</b></td>
                <td class="unit text-bold text-right">{{ $invoice->grand_total ?? 0 }} </td>
            </tr>
        </tbody>
    </table>

    @isset($invoice->additional_note)
        <div>
            <h3 class="text-black">Additional Note</h3>
            <p class="ml-10 text-justify">{{ $invoice->additional_note ?? 'N/A' }}</p>
        </div>
    @endisset

</body>

</html>
