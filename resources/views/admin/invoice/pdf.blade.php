<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Parizlab</title>

    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url('{{ public_path('admin/dist/img/dimension.png') }}');
        }

        #project {
            float: left;
            font-size: medium;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
            font-size: medium;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
            font-size: medium;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: center;
            font-size: medium;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
            width: 100%;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ public_path('admin/dist/img/logo.jpg')}}" >
    </div>
    <h1 >Invoice No# {{ $invoice->invoice_number}}</h1>
    <div id="company" class="clearfix">
        <div>Parizlab</div>
        <div>San Francisco,<br /> CA 94107, US</div>
        <div>(011) 123-456</div>
        <div><a href="#">info@parizlab.com</a></div>
    </div>
    <div id="project">
        <div><span>CLIENT :</span> {{ $invoice->customer->name ?? 'N/A' }}</div>
        <!--<div><span>ADDRESS :</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL :</span> <a href="">www@example.com</a></div>-->
        <div><span>DATE :</span> {{ $invoice->date }}</div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Description</th>
            <th>Unit Price (Rs.)</th>
            <th>Quantity</th>
            <th>Disc(%)</th>
            <th>Disc(Rs.)</th>
            <th>Subtotal (Rs.)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoice->items as $index => $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="desc">{{ $item->description }}</td>
            <td class="unit">Rs. {{ $item->unit_price }}</td>
            <td class="qty">{{ $item->quantity }}</td>
            <td class="qty">{{ $item->discount_percentage}}</td>
            <td class="qty">{{ $item->discount_amount}}</td>
            <td class="total">Rs. {{ $item->subtotal }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="grand total">TOTAL SUBTOTAL</td>
            <td class="grand total">Rs. {{ $invoice->total_subtotal }}</td>
        </tr>
        <tr>
            <td colspan="6" class="grand total">TOTAL DISCOUNT</td>
            <td class="grand total">Rs. ( {{ $invoice->total_discount }} )</td>
        </tr>
        <tr>
            <td colspan="6" class="grand total">TOTAL</td>
            <td class="grand total">Rs. {{ $invoice->total }}</td>
        </tr>
        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice"></div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
