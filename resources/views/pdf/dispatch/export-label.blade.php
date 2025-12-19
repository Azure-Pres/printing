<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRH Label</title>

    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            color: #000;
        }

        .label {
            border: 1px solid #000;
            padding: 12px 14px;
            margin-bottom: 20mm;
            font-size: 12px;
            line-height: 1.35;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .title-2 {
            font-size: 15px;
            font-weight: bold;
            margin-top: 2px;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 4px;
        }

        .hr-line {
            border: none;
            border-top: 1px solid #000;
            margin: 10px -14px;
        }

        .inline-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .mono {
            font-family: "Courier New", monospace;
            font-size: 12px;
        }

        .mono-bold {
            font-family: "Courier New", monospace;
            font-size: 14px;
            font-weight: bold;
        }

        .barcode-label {
            text-align: center;
            margin-top: 6px;
        }

        .barcode-label .ean {
            font-size: 34px;
            font-weight: bold;
        }

        .barcode-wrapper {
            text-align: center;
            margin-top: 6px;
        }

        .barcode-text {
            font-family: "Courier New", monospace;
            font-size: 11px;
            margin-top: 2px;
        }

        .footer {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top: 10px;
            text-align: center;
        }

        .price {
            font-weight: bold;
            margin-top: 6px;
        }
    </style>
</head>

<body>

@foreach ($labels as $l)

<div class="label">

    <!-- HEADER -->
    <div class="title">Title: {{ $l['title'] }}</div>
    <div class="title-2">Publisher: {{ $l['publisher'] }}</div>

    <div class="meta-row">
        <div>On Sale: {{ $l['on_sale_date'] }}</div>
        <div>PRINTED IN INDIA</div>
    </div>

    <hr class="hr-line">

    <!-- TOP INFO ROW -->
    <div class="inline-row">

        <div class="mono-bold">
            ISBN: {{ $l['isbn'] }}<br>
            BATCH: {{ $l['batch'] }}
        </div>

        <div class="barcode-label">
            BARCODE:<br>
            <span class="ean">EAN</span>
        </div>

        <div class="mono">
            PPON: {{ $l['ppon'] }}<br>
            <span>(251){{ $l['ppon'] }}</span>
        </div>

    </div>

    <!-- REAL BARCODE (ONLY ONE) -->
    <div class="barcode-wrapper">
        {!! DNS1D::getBarcodeHTML(
            preg_replace('/[^0-9]/', '', $l['isbn']),
            'EAN13',
            2,
            45
        ) !!}
        <div class="barcode-text">
            {{ preg_replace('/[^0-9]/', '', $l['isbn']) }}
        </div>
    </div>
    <hr class="hr-line">
    <!-- FOOTER -->
    <div class="footer mono">
        <div>
            CTN QTY: {{ $l['ctn_qty'] }}<br>
            (30){{ $l['ctn_qty'] }}<br><br>
            ISBN: {{ $l['isbn'] }}<br>
            (01){{ preg_replace('/[^0-9]/', '', $l['isbn']) }}0
        </div>
        <div>
            CTN WGT: {{ $l['ctn_wgt_lbs'] }} lbs<br>
            (3401)000293<br><br>
            <span class="price">
                COVER PRICE: ${{ $l['price_usd'] }} USD / ${{ $l['price_cad'] }} CAD
            </span><br>
            (9012Q)999USD
        </div>
    </div>
</div>
@endforeach

</body>
</html>
